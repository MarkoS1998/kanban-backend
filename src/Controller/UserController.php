<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

/**
 * @Route("api/v1/user/", methods={"GET"})
 */
class UserController extends AbstractController
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
    public function getUsers(Request $request) : Response
    {
        try{
            $result = [];
            
            $users = $this->em->getRepository(User::class)->findAll();
            if(!empty($users)){
                foreach($users as $user){
                    $data = [
                        'id' => $user->getId(),
                        'name' => $user->getName(),
                        'avatar_url' => $user->getAvatarUrl()
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

    /**
     * @Route("login", methods={"POST"})
     */
    public function login(Request $request) : Response
    {
        try{
            $parameters = json_decode($request->getContent(), true);
            $email = $parameters['email'];
            $password = $parameters['password'];
            $result = null;
    
            if(!empty($email) && !empty($password)){
                $user = $this->em->getRepository(User::class)->findOneBy(['email' => $email]);

                if(empty($user)){
                    throw new \Exception("There is no user with the entered email!", 404);
                }

                if($user->getPassword() != $password){
                    throw new \Exception("Incorrect password!", 400);
                }

                $result = [
                    'id' => $user->getId(),
                    'name' => $user->getName(),
                    'avatar_url' => $user->getAvatarUrl()
                ];
                
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

    /**
     * @Route("get/{id}", methods={"GET"})
     */
    public function getById(Request $request, $id) : Response
    {
        try{
            $result = null;
            $user = $this->em->getRepository(User::class)->find($id);

            if(!empty($user))
                $result = [
                    'id' => $user->getId(),
                    'name' => $user->getName(),
                    'avatar_url' => $user->getAvatarUrl()
                ];
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
