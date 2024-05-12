<?php

namespace App\Controller;

use App\Entity\Proveidors;
use App\Form\ProveidorType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProveidorsController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/', name: 'app')]
    public function mostrarProveidors() 
    {
        return $this->redirectToRoute('app_proveidors');
    }
    

    #[Route('/proveidors', name: 'app_proveidors')]
    public function index()
    {
        // TROBAR TOTS
        $proveidors = $this->em->getRepository(Proveidors::class)->findAllProveidors();
        return $this->render('proveidors/index.html.twig', [
            'proveidors' => $proveidors
        ]);
    }

    #[Route('/proveidors/new', name: 'app_new_proveidors')]
    public function new(Request $request): Response
    {
        $proveidor = new Proveidors();
        $form = $this->createForm(ProveidorType::class, $proveidor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($proveidor);
            $this->em->flush();
            return $this->redirectToRoute('app_proveidors');;
        }

        return $this->render('proveidors/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/proveidors/update/{id}', name: 'app_update_proveidors')]
    public function update($id, Request $request)
    {
        $proveidor = $this->em->getRepository(Proveidors::class)->find($id);

        if (!$proveidor) {
            throw $this->createNotFoundException('Proveedor no encontrado');
        }
    
        $form = $this->createForm(ProveidorType::class, $proveidor);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $proveidor->setEdicio(new \DateTime());
            $this->em->flush();
            return $this->redirectToRoute('app_proveidors');
        }
    
        return $this->render('proveidors/update.html.twig', [
            'form' => $form->createView()
        ]);
    
    }

    #[Route('/proveidors/remove/{id}', name: 'app_remove_proveidors')]
    public function remove($id)
    {
        $proveidor = $this->em->getRepository(Proveidors::class)->find($id);
        $this->em->remove($proveidor);
        $this->em->flush();
        return $this->redirectToRoute('app_proveidors');;
    }

    //  TROBAR EESPECÍFIC
    // $proveidor = $this->em->getRepository(Proveidors::class)->find($id);
    // $custom_proveidor = $this->em->getRepository(Proveidors::class)->findProveidor($id);
    // return $this->render('proveidors/index.html.twig', [
    //     'proveidor' => $proveidor,
    //     'custom_proveidor' => $custom_proveidor
    // ]);

    // TROBAR TOTS
    // $proveidors = $this->em->getRepository(Proveidors::class)->findAll();
    // return $this->render('proveidors/index.html.twig', [
    //     'proveidors' => $proveidors
    // ]);
}

    // CUD
    // #[Route('/proveidors/insert', name: 'app_proveidors')]
    // public function insert()
    // {
    //     $proveidor = new Proveidors('Ana Maria', 'anamaria@gmail.com', '000000000', 'Pista', 0);
    //     $this->em->persist($proveidor);
    //     $this->em->flush();
    //     return new JsonResponse(['success' => true]);
    // }

    // #[Route('/proveidors/update/{id}', name: 'app_proveidors')]
    // public function update($id)
    // {
    //     $proveidor = $this->em->getRepository(Proveidors::class)->find($id);
    //     // Aqui van tots els camps a editar
    //     $proveidor->setNom('Ana Maria Pistes');
    //     $this->em->flush();
    //     return new JsonResponse(['success' => true]);
    // }

    // #[Route('/proveidors/remove/{id}', name: 'app_proveidors')]
    // public function remove($id)
    // {
    //     $proveidor = $this->em->getRepository(Proveidors::class)->find($id);
    //     $this->em->remove($proveidor);
    //     $this->em->flush();
    //     return new JsonResponse(['success' => true]);
    // }
