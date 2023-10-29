<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Label;

/**
 * @Route("api/v1/label/", methods={"GET"})
 */
class LabelController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * EmotionController constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("get-all", methods={"GET"})
     */
    public function getLabels(Request $request) : Response
    {
        try{
            $result = [];
            
            $labels = $this->em->getRepository(Label::class)->findAll();
            if(!empty($labels)){
                foreach($labels as $label){
                    $data = [
                        'id' => $label->getId(),
                        'color' => $label->getColor()
                    ];
                    $result[] = $data;
                }
            }
        }
        catch (\Exception $e)
        {
            return new JsonResponse([
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'data' => []
            ]);
        }

        return new JsonResponse([
            'code'=>200,
            'message'=>'',
            'data'=>$result
        ]);
    }
}
