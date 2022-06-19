<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\BrowserKit\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartController extends AbstractController
{
   

    #[Route('/panier', name: 'app_cart')]
    public function index(SessionInterface $session, ProductRepository $productrepository): Response
    {
        $panier = $session->get('panier',[]);
        $panieraffichage =[];
        foreach($panier as $id => $quanity)
        {
            $panieraffichage [] =[
                'product' => $productrepository->find($id),
                'quantity'=> $quanity
            ];
        }
        $total = 0;
        foreach($panieraffichage as $item){
            $totalItem = $item['product']->getPrice()* $item['quantity'];
            $total +=$totalItem;
        }
        return $this->render('cart/index.html.twig',['items' =>$panieraffichage, 'total' => $total]);
    }


    #[Route('/panier/add/{id}', name: 'app_add')]
    public function add($id, SessionInterface $session  ): Response
    {
        //recuperer les données dans ma bate de donne
        //$session = $request->getSession();
        //ajouter dans mon panier 
        $panier = $session->get('panier',[]);
        //ajouter en le meme produit si mon panier contient au mon un produit sinon 
        if (!empty($panier[$id])){
            $panier[$id]++;
        }
        else{
            $panier[$id] = 1;
        }
        
        $session->set('panier', $panier);
        return $this->redirectToRoute("app_cart");
        
       
    }

    #[Route('/panier/remove/{id}', name:'app_remove')]
    public function remove($id,SessionInterface $session ){
        $panier = $session->get('panier', []);
        if (!empty($panier[$id])){
            unset($panier[$id]);
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute("app_cart");
    }


}
