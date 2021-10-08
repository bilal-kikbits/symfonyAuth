<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(PostRepository $postRepository){
        $posts=$postRepository->findBy(array(),array('user' => 'DESC'));
        //dd($posts);
        // dd($post);
        return $this->render('home/index.html.twig',[
            'posts'=> $posts,
        ]);

    }

    /**
     * @Route("/custom/{id}", name="custom")
     * @param Request $request
     * @return Response
     */
    public function custom(PostRepository $postRepository,$id){
        $post=$postRepository->find($id);
        // dd($post);
        return $this->render('home/custom.html.twig',[
            'post'=> $post,
        ]);
    }
}
