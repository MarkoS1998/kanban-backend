<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Task;
use App\Entity\TaskList;
use App\Entity\User;
use App\Entity\Label;
use DateTime;

/**
 * @Route("api/v1/task/", methods={"GET"})
 */
class TaskController extends AbstractController
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
    public function createTask(Request $request) : Response
    {
        try{
            $parameters = json_decode($request->getContent(), true);
            $data = $parameters['data'];

            $result = -1;

            if(!empty($data)){
                $taskList = $this->em->getRepository(TaskList::class)->find($data['task_list_id']);
                if($taskList){

                    $taskEntity = new Task();
                    $taskEntity->setName($data['name']);
                    $taskEntity->setIsCompleted(false);
                    $taskEntity->setPosition($data['position']);
                    $taskEntity->setStartOn(null);
                    $taskEntity->setDueOn(null);
                    $taskEntity->setOpenSubtasks(0);
                    $taskEntity->setCommentsCount(0);
                    $taskEntity->setIsImportant(false);
                    $taskEntity->setCompletedOn(null);
                    $taskEntity->setTaskList($taskList);

                    $this->em->persist($taskEntity);
                    $this->em->flush();

                    $result = $taskEntity->getId();
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
    public function getTasks(Request $request) : Response
    {
        try{
            $result = [];
            
            $tasks = $this->em->getRepository(Task::class)->findAll();
            if(!empty($tasks)){
                foreach($tasks as $task){
                    $taskList = $task->getTaskList();
                    $task_list_id = $taskList->getId();

                    $assignee = [];
                    $task_assignee = $task->getAssignee();
                    if(!empty($task_assignee))
                        foreach($task_assignee as $task_assign)
                            $assignee[] = $task_assign->getId();

                    $labels = [];
                    $task_labels = $task->getLabels();
                    if(!empty($task_labels))
                        foreach($task_labels as $task_label)
                            $labels[] = $task_label->getId();

                    $start_on = $task->getStartOn() != null ? $task->getStartOn()->format('Y-m-d') : null;
                    $due_on = $task->getDueOn() != null ? $task->getDueOn()->format('Y-m-d') : null;
                    $completed_on = $task->getCompletedOn() != null ? $task->getCompletedOn()->format('Y-m-d') : null;

                    $data = [
                        'id' => $task->getId(),
                        'name' => $task->getName(),
                        'is_completed' => $task->isIsCompleted(),
                        'task_list_id' => $task_list_id,
                        'position' => $task->getPosition(),
                        'start_on' => $start_on,
                        'due_on' => $due_on,
                        'labels' => $labels,
                        'open_subtasks' => $task->getOpenSubtasks(),
                        'comments_count' => $task->getCommentsCount(),
                        'assignee' => $assignee,
                        'is_important' => $task->isIsImportant(),
                        'completed_on' => $completed_on,
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
     * @Route("update-position", methods={"PUT"})
     */
    public function updateTaskPosition(Request $request) : Response
    {
        try{
            $parameters = json_decode($request->getContent(), true);
            $data = $parameters['data'];

            if(!empty($data)){
                $taskListIds = array_keys($data);

                if(!empty($taskListIds)){
                    foreach($taskListIds as $taskListId){
                        $taskIds = $data[$taskListId];

                        $taskList = $this->em->getRepository(TaskList::class)->find($taskListId);
                        if(!empty($taskList) && !empty($taskIds)){
                            $pos = 0;
                            
                            foreach($taskIds as $taskId){
                                $task = $this->em->getRepository(Task::class)->find($taskId);
                                
                                $task->setPosition($pos);
                                $task->setTaskList($taskList);

                                $this->em->persist($task);
                                $this->em->flush();

                                $pos++;
                            }
                        }
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
            'data'=>[]
        ]);
    }

    /**
     * @Route("complete", methods={"PUT"})
     */
    public function completeTask(Request $request) : Response
    {
        try{
            $parameters = json_decode($request->getContent(), true);
            $taskId = $parameters['id'];

            if(!empty($taskId)){
                $task = $this->em->getRepository(Task::class)->find($taskId);
                                
                if(!empty($task)){          
                    $task->setIsCompleted(true);
                    $task->setCompletedOn(new \DateTime());

                    $this->em->persist($task);
                    $this->em->flush();
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
            'data'=>[]
        ]);
    }

    /**
     * @Route("reopen", methods={"PUT"})
     */
    public function reopenTask(Request $request) : Response
    {
        try{
            $parameters = json_decode($request->getContent(), true);
            $taskId = $parameters['id'];
            
            if(!empty($taskId)){
                $task = $this->em->getRepository(Task::class)->find($taskId);
                 
                if(!empty($task)){ 
                    $task->setIsCompleted(false);
                    $task->setCompletedOn(null);

                    $this->em->persist($task);
                    $this->em->flush();
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
            'data'=>[]
        ]);
    }

    /**
     * @Route("add-member", methods={"PUT"})
     */
    public function addMember(Request $request) : Response
    {
        try{
            $parameters = json_decode($request->getContent(), true);
            $taskId = $parameters['id'];
            $userId = $parameters['user_id'];

            if(!empty($taskId)){
                $task = $this->em->getRepository(Task::class)->find($taskId);
                if(!empty($task)){ 
                    $user = $this->em->getRepository(User::class)->find($userId);  
                    if(!empty($user)){          
                        $task->addAssignee($user);
    
                        $this->em->persist($task);
                        $this->em->flush();
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
            'data'=>[]
        ]);
    }

    /**
     * @Route("remove-member", methods={"PUT"})
     */
    public function removeMember(Request $request) : Response
    {
        try{
            $parameters = json_decode($request->getContent(), true);
            $taskId = $parameters['id'];
            $userId = $parameters['user_id'];

            if(!empty($taskId)){
                $task = $this->em->getRepository(Task::class)->find($taskId);
                if(!empty($task)){ 
                    $user = $this->em->getRepository(User::class)->find($userId);  
                    if(!empty($user)){          
                        $task->removeAssignee($user);
    
                        $this->em->persist($task);
                        $this->em->flush();
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
            'data'=>[]
        ]);
    }

    /**
     * @Route("add-label", methods={"PUT"})
     */
    public function addLabel(Request $request) : Response
    {
        try{
            $parameters = json_decode($request->getContent(), true);
            $taskId = $parameters['id'];
            $labelId = $parameters['label_id'];

            if(!empty($taskId)){
                $task = $this->em->getRepository(Task::class)->find($taskId);
                if(!empty($task)){ 
                    $label = $this->em->getRepository(Label::class)->find($labelId);  
                    if(!empty($label)){          
                        $task->addLabel($label);
    
                        $this->em->persist($task);
                        $this->em->flush();
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
            'data'=>[]
        ]);
    }

    /**
     * @Route("remove-label", methods={"PUT"})
     */
    public function removeLabel(Request $request) : Response
    {
        try{
            $parameters = json_decode($request->getContent(), true);
            $taskId = $parameters['id'];
            $labelId = $parameters['label_id'];

            if(!empty($taskId)){
                $task = $this->em->getRepository(Task::class)->find($taskId);
                if(!empty($task)){ 
                    $label = $this->em->getRepository(Label::class)->find($labelId);  
                    if(!empty($label)){          
                        $task->removeLabel($label);
    
                        $this->em->persist($task);
                        $this->em->flush();
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
            'data'=>[]
        ]);
    }

    /**
     * @Route("edit-name", methods={"PUT"})
     */
    public function editTaskName(Request $request) : Response
    {
        try{
            $parameters = json_decode($request->getContent(), true);
            $taskId = $parameters['id'];
            $name = $parameters['name'];

            if(!empty($taskId)){
                $task = $this->em->getRepository(Task::class)->find($taskId);
                if(!empty($task)){    
                    $task->setName($name);
    
                    $this->em->persist($task);
                    $this->em->flush();  
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
            'data'=>[]
        ]);
    }
}
