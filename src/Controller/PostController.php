<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Post;
use App\Entity\User;
use App\Form\PostType;
use App\Form\PostUpdateType;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/post", name="post.")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(PostRepository $postRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user= $this->getUser();
        $id=$this->getDoctrine()->getRepository(User::class)->find($user);
        //dd($id->getId(),$id->getPost());
        $posts=$postRepository->findBy([
            'user'=>$id
        ]);
       // dd($posts);

        return $this->render('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * @Route("/create", name="create")
     */

    public function create(Request $request){

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user= $this->getUser();

        $post= new Post();
        $post->setUser($user);
        //dd($post,$id);
        $category= new Category();
       // dd($post,$category);
        $form= $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        $form->getErrors();
        if ($form->isSubmitted() && $form->isValid()){
            $entityManager= $this->getDoctrine()->getManager();
            /**
             * @var UploadedFile $file
             */
            $file=$request->files->get('post')['attachment'];
            if ($file){
                $filename= md5(uniqid()).'.'.$file->guessClientExtension();
                $file->move($this->getParameter('uploads_dir'),$filename);
                $post->setImage($filename);
            }
            //$post=$post->getCategory();
            $entityManager->persist($post);

           // $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash('success','Post created successfully');
            return $this->redirectToRoute('post.index');
        }



        return $this->render('post/create.html.twig',[
            'form'=> $form->createView(),
        ]);
    }

    /**
     * @Route("/show/{id}", name="show")
     */

    public function show(PostRepository $postRepository,$id){
        $post=$postRepository->find($id);
       // dd($post);
        return $this->render('post/show.html.twig',[
            'post'=> $post,
        ]);
    }

    /**
     * @Route ("edit/{id}", name="edit")
     */

    public function edit(Request  $request,$id){
        $post= new Post();
        $post=$this->getDoctrine()->getRepository(Post::class)->find($id);
        $form= $this->createForm(PostUpdateType::class, $post);
        $form->handleRequest($request);
        //$form->getRawValue();
        $form->getErrors();
        if ($form->isSubmitted() && $form->isValid()){
            $entityManager= $this->getDoctrine()->getManager();
            $entityManager->flush();
            $this->addFlash('success','Post updated successfully');
            return $this->redirectToRoute('post.index');

        }



        return $this->render('post/create.html.twig',[
            'form'=> $form->createView(),
        ]);

    }

    /**
     * @Route("/delete/{id}", name="delete")
     * Method({"POST"})
     */

    public function delete(PostRepository $postRepository,$id){
        $post=$postRepository->find($id);
        $entityManager=$this->getDoctrine()->getManager();
        $entityManager->remove($post);
        $entityManager->flush();
        $this->addFlash('success','Post deleted successfully');
        return $this->redirectToRoute('post.index');
    }
}
