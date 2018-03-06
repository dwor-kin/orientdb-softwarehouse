<?php

namespace AppBundle\Controller;

use PhpOrient\Protocols\Binary\Data\Record;
use PhpOrient\Protocols\Common\ClustersMap;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use PhpOrient\PhpOrient;

class MainController extends Controller
{
    /**
     * @Route("/main", name="main")
     */
    public function indexAction()
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', []);
    }

    /**
     * @Route("/main/get-person-info", name="main:get-person-info")
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getFullSelectedUserInfo(Request $request)
    {
        $basicDataProvider = $this->get('app.service.basic-data.provider');
        $userData = $basicDataProvider->getFullPersonData($request->request->get('rid'));

        return new JsonResponse(array(
            'success' => true,
            'response'  => $userData
        ), 200);
    }

    /**
     * @Route("/main/get-software-house-details", name="main:software-house:details")
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getSoftwareHouseDetails(Request $request)
    {
        $basicDataProvider = $this->get('app.service.basic-data.provider');
        return new JsonResponse(array(
            'success' => true,
            'response'  => array(
                'office'        => $basicDataProvider->getAllOffices(),
                'technology'    => $basicDataProvider->getAllTechnologies()
            )
        ), 200);
    }
}
