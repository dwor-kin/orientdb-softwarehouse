<?php

namespace AppBundle\Controller;

use AppBundle\Component\Form\PersonType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PersonController extends Controller
{
    /**
     * @Route("/person/set-new-person", name="person:set-record")
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function setNewPerson(Request $request)
    {
        $personHandler = $this->get('app.service.person.handler');

        $form = $this->createForm(PersonType::class, null, ['method' => 'POST']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $success = $personHandler->addNewPerson($form->getData());
        } else {
            $success = false;
        }

        return new JsonResponse(array(
            'success' => $success
        ), 200);
    }

    /**
     * @Route("/person/get-list", name="person:get-list")
     *
     * @return JsonResponse
     */
    public function getPersonList()
    {
        $basicDataProvider = $this->get('app.service.basic-data.provider');
        return $this->render('person/list-person.html.twig', [
            'response'  => $basicDataProvider->getAllPersons()
        ]);
    }
}
