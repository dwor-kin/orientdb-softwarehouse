<?php

namespace AppBundle\Controller;

use AppBundle\Component\Form\PersonType;
use AppBundle\Component\Form\ProjectAssignmentType;
use AppBundle\Component\Form\ProjectType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ProjectController extends Controller
{
    /**
     * @Route("/project/get-projects", name="project:get-projects")
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getProjects(Request $request)
    {
        $personProvider = $this->get('app.service.person.provider');
        $projectProvider = $this->get('app.service.project.provider');

        $projects = $projectProvider->getAllProjects();
        $peopleInProject = array();
        $peopleToProject = array();
        $selected = null;

        $form = $this->createForm(ProjectType::class, null, ['method' => 'POST']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $peopleInProject = $personProvider->getPeopleByProject($request->request->get('projectId'));
            $peopleToProject = $personProvider->getPersonsWithoutProject();
            $selected = $request->request->get('projectId');
        }

        return $this->render('project/assign_to_project.html.twig', [
            'projects'          => $projects,
            'peopleInProject'   => $peopleInProject,
            'peopleToProject'   => $peopleToProject,
            'selected'          => $selected
        ]);
    }

    /**
     * @Route("/project/assign-to-project", name="project:assign-to-project")
     * @param Request $request
     * @return JsonResponse
     */
    public function assignToProject(Request $request)
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
    public function removeFromProject()
    {
        return new JsonResponse(array(
            'success' => true
        ), 200);
    }


}
