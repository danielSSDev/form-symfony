<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormClientController extends AbstractController
{
    /**
     * @Route("/client", name="client_index")
     */
    public function index(ClientRepository $clientRespository) : Response
    {
        $data['clients'] = $clientRespository->findAll();
        $data['titulo'] = 'Gerenciar os Clientes';
        return $this->render('client/index.html.twig', $data);
    }

    /**
     * @Route("/client/create", name="client_create")
     */
    public function create(Request $request, EntityManagerInterface $em) : Response
    {
        $msg = '';
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($client);
            $em->flush();
            $msg = 'Cliente salvo com sucesso';
        }

        $data['titulo'] = 'Adicionar novo cliente';
        $data['form'] = $form;
        $data['msg'] = $msg;

        return $this->renderForm('client/form.html.twig', $data);
    }

     /**
     * @Route("/client/editar/{id}", name="client_edit")
     */
     public function edit($id, Request $request, EntityManagerInterface $em, ClientRepository $clientRepository) : Response
     {
        $msg = '';
        $client = $clientRepository->find($id);
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->flush();
            $msg = 'Cliente Atualizado com Sucesso';
        }

        $data['titulo'] = 'Editar Cliente';
        $data['form'] = $form;
        $data['msg'] = $msg;
        return $this->renderForm('client/form.html.twig', $data);
     }


    /**
     * @Route("/client/delete/{id}", name="client_delete")
     */
    public function delete($id, EntityManagerInterface $em, ClientRepository $clientRepository) : Response
    {
        $client = $clientRepository->find($id);
        $em->remove($client);
        $em->flush();
        return $this->redirectToRoute('client_index');
    }


}