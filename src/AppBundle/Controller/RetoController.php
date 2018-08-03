<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Producto;
use AppBundle\Entity\Categoria;
use AppBundle\Form\ProductoType;
use Symfony\Component\HttpFoundation\JsonResponse;

class RetoController extends Controller
{
 
    public function indexAction(Request $request,$name,$page)
    {
        //return $this ->redirect($this->generateUrl("helloWorld"));
        
        //var_dump($request->query->get("hola"));
        //var_dump($request->get("hola-post"));
        //die();
        // replace this example code with whatever you need
        return $this->render('@App/Reto/index.html.twig', [
            'texto' => $name."-".$page
        ]);
    }
    
    public function createAction(Request $request)
    {
        $category = new Categoria();
        
        
        $em = $this->getDoctrine()->getManager();        
        $em->persist($category);
        $em->persist($producto);
        $em->flush();
        
        echo "<h1>Saved new product with id".$producto->getId()."</h1>";
        die();
        //return new Response('Saved new product with id '.$producto->getId());
    }
    
    
    public function readAction(Request $request)
    {   
        $em = $this->getDoctrine()->getManager(); 
        $rep = $em ->getRepository("AppBundle:Producto");
        $productos=$rep->findAll();
                
        return $this->render('@App/Reto/index.html.twig', [
            'productos' => $productos
        ]);
    }
    
    public function crudAction(Request $request)
    {
       
        $em = $this->getDoctrine()->getManager(); 
        $rep = $em ->getRepository("AppBundle:Producto");
        $productos=$rep->findAll();
        
        $em2 = $this->getDoctrine()->getManager(); 
        $rep2 = $em ->getRepository("AppBundle:Categoria");
        $categorias=$rep2->findAll();
        
        $arrayCategoria = array();
            
        foreach($categorias as $categoria){   
            
            array_push ($arrayCategoria, array($categoria->getNombre() => $categoria) ); 
         }    
        
        $post= new Producto();
        $form = $this->createForm(ProductoType::class,$post,array('categorias'=>$arrayCategoria));
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
                   
            $em2 = $this->getDoctrine()->getManager();
            $repository2 = $em2->getRepository('AppBundle:Categoria');
            $resultado = $repository2->findOneById($post->getIdcategoria());

            $post->setIdcategoria($resultado);

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
                
            return $this->redirectToRoute('reto_crud');
        }
        
        $post2= new Producto();
        $form2 = $this->createForm(ProductoType::class,$post2,array('categorias'=>$arrayCategoria));
        $form2->handleRequest($request);
        
        if ($form2->isSubmitted() && $form2->isValid()) {
            
           
            return $this->redirectToRoute('reto_crud');
        }

        return $this->render('@App/Reto/index.html.twig', [
            'form' => $form->createView(),
            'form2' => $form2->createView(),
            'productos' => $productos,
            'categorias'=>$categorias
        ]);
    }   
    
    
    public function actualizarAction(Request $request){

        $id=$_POST['id'];
        $nombre=$_POST["nombre"];
        $categoria=$_POST["categoria"];
        $preciocompra=$_POST["preciocompra"];
        $precioventa=$_POST["precioventa"];

        $em3 = $this->getDoctrine()->getManager();
        $repository2 = $em3->getRepository('AppBundle:Producto');
        $resultado = $repository2->findOneById($id);  

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Categoria');
        $category= $repository->findOneById($categoria);


        $resultado->setIdcategoria($category);
        $resultado->setNombre($nombre);
        $resultado->setPreciocompra($preciocompra);
        $resultado->setPrecioventa($precioventa);

        $em->persist($resultado);
        $flush = $em->flush();
            
        //return new Response('Respuesta simple!');
        return $this->redirectToRoute('reto_crud');
    }

     public function eliminarAction(Request $request){

        $id=$_POST['id'];

        $em = $this->getDoctrine()->getManager();
        $repository2 = $em->getRepository('AppBundle:Producto');
        $resultado = $repository2->findOneById($id);  

        $em->remove($resultado);
        $flush=$em->flush();
            
        //return new Response('Respuesta simple!');
        return $this->redirectToRoute('reto_crud');
    }
    
    public function eliminarMasivoAction(Request $request){

        $id=$_POST['id'];

        foreach ($id as $valor) {
             $em = $this->getDoctrine()->getManager();
            $repository2 = $em->getRepository('AppBundle:Producto');
            $resultado = $repository2->findOneById($valor);  

            $em->remove($resultado);
            $flush=$em->flush();
        }
        
            
        //return new Response('Respuesta simple!');
        return $this->redirectToRoute('reto_crud');
    }
    
    //Reto 2
    
    public function reto2Action(Request $request,$idCategoria)
    {   
       
        return $this->render('@App/Reto/reto2.html.twig', [
            'id_categoria' => $idCategoria
        ]);
    }
    
    public function apiAction(Request $request,$idCategoria){

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Producto');
        $resultado = $repository->findByIdcategoria($idCategoria);  
            
        $arrayCollection = array ();

        foreach ($resultado as $item) {
             $arrayCollection [] = array (
                 'nombre' => $item-> getNombre(),
                 'categoria' => $item-> getIdcategoria()-> getNombre(),
                 'precioCompra' => $item-> getPreciocompra(),
                 'precioVenta' => $item-> getPrecioventa(),
             );
        }

        return new JsonResponse ($arrayCollection);
    }
    
    
    
    
}
