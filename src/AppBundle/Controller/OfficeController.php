<?php

namespace AppBundle\Controller;

use AppBundle\Component\Form\OfficeType;
use AppBundle\Component\Form\ProjectAssignmentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class OfficeController extends Controller
{
    /**
     * @Route("/office/get-offices", name="office:get-offices")
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getOffices(Request $request)
    {
        $personProvider = $this->get('app.service.person.provider');
        $officeProvider = $this->get('app.service.office.provider');

        $offices = $officeProvider->getAllOffices();
        $peopleInOffice = array();
        $peopleToOffice = array();
        $selected = null;

        $form = $this->createForm(OfficeType::class, null, ['method' => 'POST']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $peopleInOffice = $personProvider->getPeopleByOffice($request->request->get('officeRef'));
            $peopleToOffice = $personProvider->getPersonsWithoutOffice();
            $selected = $request->request->get('projectId');
        }

        return $this->render('office/assign_to_office.html.twig', [
            'offices'           => $offices,
            'peopleInOffice'    => $peopleInOffice,
            'peopleToOffice'    => $peopleToOffice,
            'selected'          => $selected
        ]);
    }

    /**
     * @Route("/project/assign-to-project", name="project:assign-to-project")
     * @param Request $request
     * @return JsonResponse
     */
    public function assignToOffice(Request $request)
    {
        $form = $this->createForm(ProjectAssignmentType::class, null, ['method' => 'POST']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

        }

        return new JsonResponse(array(
            'success' => true
        ), 200);
    }

    /**
     * @Route("/project/remove-from-project", name="project:remove-from-project")
     *
     * @return JsonResponse
     */
    public function removeFromOffice()
    {
        return new JsonResponse(array(
            'success' => true
        ), 200);
    }


}
