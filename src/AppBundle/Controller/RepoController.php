<?php

namespace AppBundle\Controller;

use AppBundle\Component\Form\LeaderSelection;
use AppBundle\Component\Form\ProjectType;
use AppBundle\Component\Form\TechnologySelection;
use AppBundle\Component\Form\UnemployedSelection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RepoController extends Controller
{
    /**
     * @Route("/report/unemployment", name="report:unemployed")
     *
     * @param Request $request
     * @return Response
     */
    public function unemployedController(Request $request)
    {
        $reportProvider = $this->get('app.service.report.provider');
        $basicDataProvider = $this->get('app.service.basic-data.provider');
        $offices = $basicDataProvider->getAllOffices();
        $responseData = array();
        $selected = '';

        if ($request->getMethod() == 'POST') {
            $form = $this->createForm(UnemployedSelection::class, null, ['method' => 'POST']);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $responseData = $reportProvider->getUnemployed($request->request->get('cityId'));
                $selected = $request->request->get('cityId');
            }
        }
        return $this->render('report/unemployed.html.twig', [
            'response'  => $responseData,
            'offices'   => $offices,
            'selected'  => $selected
        ]);
    }

    /**
     * @Route("/report/leading-by", name="report:leading-by")
     *
     * @param Request $request
     * @return Response
     */
    public function leadingByController(Request $request)
    {
        $reportProvider = $this->get('app.service.report.provider');
        $basicDataProvider = $this->get('app.service.basic-data.provider');
        $leaders = $basicDataProvider->getAllLeadersAndHeads();
        $responseData = array();
        $selected = '';

        if ($request->getMethod() == 'POST') {
            $form = $this->createForm(LeaderSelection::class, null, ['method' => 'POST']);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $responseData = $reportProvider->getPeopleByLeader($request->request->get('rid'));
                $selected = $request->request->get('rid');
            }
        }

        return $this->render('report/leading-by.html.twig', [
            'response'  => $responseData,
            'leaders'   => $leaders,
            'selected'  => $selected
        ]);
    }

    /**
     * @Route("/report/assign-to-project", name="report:assign-to-project")
     *
     * @param Request $request
     * @return Response
     */
    public function assignToProjectController(Request $request)
    {
        $reportProvider = $this->get('app.service.report.provider');
        $basicDataProvider = $this->get('app.service.basic-data.provider');
        $projects = $basicDataProvider->getAllProjects();
        $responseData = array();
        $selected = '';

        if ($request->getMethod() == 'POST') {
            $form = $this->createForm(ProjectType::class, null, ['method' => 'POST']);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $responseData = $reportProvider->getPeopleByProject($request->request->get('projectId'));
                $selected = $request->request->get('projectId');
            }
        }

        return $this->render('report/assign-to-project.html.twig', [
            'response'  => $responseData,
            'projects'  => $projects,
            'selected'  => $selected
        ]);
    }

    /**
     * @Route("/report/lead-by-head", name="report:lead-by-head")
     *
     * @param Request $request
     * @return Response
     */
    public function leadingByHeadController(Request $request)
    {
        $reportProvider = $this->get('app.service.report.provider');
        $basicDataProvider = $this->get('app.service.basic-data.provider');
        $headers = $basicDataProvider->getAllHeaders();
        $responseData = array();
        $selected = '';

        if ($request->getMethod() == 'POST') {
            $form = $this->createForm(LeaderSelection::class, null, ['method' => 'POST']);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $responseData = $reportProvider->getPeopleByHead($request->request->get('rid'));
                $selected = $request->request->get('rid');
            }
        }

        return $this->render('report/leading-by-head.html.twig', [
            'response'  => $responseData,
            'headers'   => $headers,
            'selected'  => $selected
        ]);
    }

    /**
     * @Route("/report/people-by-technology", name="report:people-by-technology")
     */
    public function peopleByTechnologyController(Request $request)
    {
        $reportProvider = $this->get('app.service.report.provider');
        $basicDataProvider = $this->get('app.service.basic-data.provider');
        $technologies = $basicDataProvider->getAllTechnologies();
        $responseData = array();
        $selected = '';

        if ($request->getMethod() == 'POST') {
            $form = $this->createForm(TechnologySelection::class, null, ['method' => 'POST']);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $responseData = $reportProvider->getPeopleByTechnology($request->request->get('rid'));
                $selected = $request->request->get('rid');
            }
        }

        return $this->render('report/people-by-technology.html.twig', [
            'response'  => $responseData,
            'technologies'   => $technologies,
            'selected'  => $selected
        ]);
    }

    /**
     * @Route("/report/people-in-all-projects", name="report:people-in-all-projects")
     */
    public function allPeopleInAllProjectController()
    {
        $reportProvider = $this->get('app.service.report.provider');
        $responseData = $reportProvider->getPeopleInAllProject();

        return $this->render('report/people-in-all-projects.html.twig', [
            'response'  => $responseData
        ]);
    }
}
