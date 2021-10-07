<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        $posts=$postRepository->findAll();

        return $this->render('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * @Route("/create", name="create")
     */

    public function create(Request $request){
        $post= new Post();
        $form= $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        $form->getErrors();
        if ($form->isSubmitted() && $form->isValid()){
            $entityManager= $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();
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
