<?php

namespace App\Controller;

use App\Entity\Objet;
use App\Repository\ObjetRepository;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MatchingController extends AbstractController
{
    #[Route('/matching', name: 'app_matching')]
    public function index(ObjetRepository $objetRepository): Response
    {

        $objectsbycategories = [];
        $objectsbydetails = [];
        $objectCities = [];

        $objects = $objetRepository->findObjectsByUser($this->getUser());

        $othersLostObjects = $objetRepository->LostObjectsByOthers($this->getUser());

        $m = 0;
        $o = 0;
        foreach ($objects as $key => $mine) {

            $m++;
            foreach ($othersLostObjects as $key => $others) {

                if ($mine->getCategory()->getId() == $others->getCategory()->getId() && $mine->getCategoryDetails()->getId() == $others->getCategoryDetails()->getId() && $mine->getLostCity() == $others->getLostCity()) {
                    if (!in_array($others, $objectCities, true)) {
                        $objectCities[] =  $others;
                    }
                }
                if ($mine->getCategory()->getId() == $others->getCategory()->getId() && $mine->getCategoryDetails()->getId() == $others->getCategoryDetails()->getId()) {
                    if (!in_array($others, $objectsbydetails, true)) {
                        $objectsbydetails[] =  $others;
                    }
                }
                if (!in_array($others, $objectsbycategories, true) && $mine->getCategory()->getId() == $others->getCategory()->getId()) {
                    if (!in_array($others, $objectsbycategories, true)) {
                        $objectsbycategories[] =  $others;
                    }
                }
            }
        };

        $objectsbydetails  = array_diff($objectsbydetails, $objectCities);
        $objectsbycategories = array_diff($objectsbycategories, $objectsbydetails, $objectCities);

        return $this->render('matching/index.html.twig', [
            'objectsLostOthersByCategories' => $objectsbycategories,
            'objectsLostOthersByDetails' => $objectsbydetails,
            'objectsLostname' => $objectCities
        ]);
    }

    #[Route('/matching/{id}', name: 'matching_object_details')]
    public function Objectdetails(Objet $objet): Response
    {
       
        return $this->render('matching/matchingobjectdetails.html.twig', [

            'objet' => $objet,
        ]);
    }
}
