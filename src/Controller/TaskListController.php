<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\TaskList;

/**
 * @Route("api/v1/task-list/", methods={"GET"})
 */
class TaskListController extends AbstractController
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
     * @Route("create", methods={"POST"})
     */
    public function createTaskList(Request $request) : Response
    {
        try{
            $parameters = json_decode($request->getContent(), true);
            $data = $parameters['data'];

            $result = -1;

            if(!empty($data)){
                if(empty($this->em->getRepository(TaskList::class)->findOneBy(['name' => $data['name']]))){

                    $taskListEntity = new TaskList();
                    $taskListEntity->setName($data['name']);
                    $taskListEntity->setOpenTasks(0);
                    $taskListEntity->setCompletedTasks(0);
                    $taskListEntity->setPosition($data['position']);
                    $taskListEntity->setIsCompleted(false);
                    $taskListEntity->setIsTrashed(false);

                    $this->em->persist($taskListEntity);
                    $this->em->flush();

                    $result = $taskListEntity->getId();
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
     * @Route("get-all", methods={"GET"})
     */
    public function getTaskLists(Request $request) : Response
    {
        try{
            $result = [];
            
            $taskLists = $this->em->getRepository(TaskList::class)->findAll();
            if(!empty($taskLists)){
                foreach($taskLists as $taskList){
                    $data = [
                        'id' => $taskList->getId(),
                        'name' => $taskList->getName(),
                        'open_tasks' => $taskList->getOpenTasks(),
                        'completed_tasks' => $taskList->getCompletedTasks(),
                        'position' => $taskList->getPosition(),
                        'is_completed' => $taskList->isIsCompleted(),
                        'is_trashed' => $taskList->isIsTrashed(),
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
     * @Route("get-all-active", methods={"GET"})
     */
    public function getActiveTaskLists(Request $request) : Response
    {
        try{
            $result = [];
            
            $taskLists = $this->em->getRepository(TaskList::class)->findAll();
            if(!empty($taskLists)){
                foreach($taskLists as $taskList){
                    if(!$taskList->isIsCompleted() && !$taskList->isIsTrashed()){
                        $data = [
                            'id' => $taskList->getId(),
                            'name' => $taskList->getName(),
                            'open_tasks' => $taskList->getOpenTasks(),
                            'completed_tasks' => $taskList->getCompletedTasks(),
                            'position' => $taskList->getPosition(),
                            'is_completed' => $taskList->isIsCompleted(),
                            'is_trashed' => $taskList->isIsTrashed(),
                        ];
                        $result[] = $data;
                    }
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
     * @Route("complete", methods={"PUT"})
     */
    public function completeTaskList(Request $request) : Response
    {
        try{
            $parameters = json_decode($request->getContent(), true);
            $taskListId = $parameters['id'];

            $taskList = $this->em->getRepository(TaskList::class)->find($taskListId);
            if(!empty($taskList)){
                $taskList->setIsCompleted(true);

                $tasks = $taskList->getTasks();
                if(!empty($tasks)){
                    foreach($tasks as $task){
                        $task->setIsCompleted(true);
                        $task->setCompletedOn(new \DateTime());
        
                        $this->em->persist($task);
                    }
                }
                $this->em->persist($taskList);
                $this->em->flush();
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
            'data'=>[]
        ]);
    }

    /**
     * @Route("delete/{id}", methods={"DELETE"})
     */
    public function deleteTaskList(Request $request, $id) : Response
    {
        try{
            $taskList = $this->em->getRepository(TaskList::class)->find($id);
            if(!empty($taskList)){
                $taskList->setIsTrashed(true);
                $this->em->persist($taskList);
                $this->em->flush();
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
            'data'=>[]
        ]);
    }
}
