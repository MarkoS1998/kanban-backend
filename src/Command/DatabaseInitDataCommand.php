<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Entity\Label;
use App\Entity\TaskList;
use App\Entity\Task;
use DateTime;

#[AsCommand(
    name: 'database:init_data',
    description: 'This command is used to initialize the database.',
)]
class DatabaseInitDataCommand extends Command
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $fileData = file_get_contents(__DIR__ . '\data.json');
        $jsonData = json_decode($fileData, true);

        $users = $jsonData['users'];

        foreach($users as $user){
            if(empty($this->em->getRepository(User::class)->findOneBy(['name' => $user['name']]))){
                $userEntity = new User();
                $userEntity->setName($user['name']);
                $userEntity->setAvatarUrl($user['avatar_url']);
				$userEntity->setEmail($user['email']);
                $userEntity->setPassword($user['password']);
                $this->em->persist($userEntity);
            }
        }
        $this->em->flush();

        $io->success('Users successfuly added in database');

        $labels = $jsonData['labels'];

        foreach($labels as $label){
            if(empty($this->em->getRepository(Label::class)->findOneBy(['color' => $label['color']]))){
                $labelEntity = new Label();
                $labelEntity->setColor($label['color']);
                $this->em->persist($labelEntity);
            }
        }
        $this->em->flush();

        $io->success('Labels successfuly added in database');

        $taskLists = $jsonData['task_lists'];

        foreach($taskLists as $taskList){
            if(empty($this->em->getRepository(TaskList::class)->findOneBy(['name' => $taskList['name']]))){
                $taskListEntity = new TaskList();
                $taskListEntity->setName($taskList['name']);
                $taskListEntity->setOpenTasks($taskList['open_tasks']);
                $taskListEntity->setCompletedTasks($taskList['completed_tasks']);
                $taskListEntity->setPosition($taskList['position']);
                $taskListEntity->setIsCompleted($taskList['is_completed']);
                $taskListEntity->setIsTrashed($taskList['is_trashed']);
                $this->em->persist($taskListEntity);
            }
        }
        $this->em->flush();

        $io->success('Task lists successfuly added in database');

        $tasks = $jsonData['tasks'];

        foreach($tasks as $task){
            if(empty($this->em->getRepository(Task::class)->findOneBy(['name' => $task['name']]))){

                $start_on = $task['start_on'] != null ? new \DateTime($task['start_on']) : null;
                $due_on = $task['due_on'] != null ? new \DateTime($task['due_on']) : null;
                $completed_on = $task['completed_on'] != null ? new \DateTime($task['completed_on']) : null;

                $taskEntity = new Task();
                $taskEntity->setName($task['name']);
                $taskEntity->setIsCompleted($task['is_completed']);
                $taskEntity->setPosition($task['position']);
                $taskEntity->setStartOn($start_on);
                $taskEntity->setDueOn($due_on);
                $taskEntity->setOpenSubtasks($task['open_subtasks']);
                $taskEntity->setCommentsCount($task['comments_count']);
                $taskEntity->setIsImportant($task['is_important']);
                $taskEntity->setCompletedOn($completed_on);

                $taskLabelIds = $task['labels'];

                foreach($taskLabelIds as $taskLabelId){
                    $taskLabel = $this->em->getRepository(Label::class)->find($taskLabelId);

                    if($taskLabel){
                        $taskEntity->addLabel($taskLabel);
                    }
                }

                $taskUserIds = $task['assignee'];

                foreach($taskUserIds as $taskUserId){
                    $taskUser = $this->em->getRepository(User::class)->find($taskUserId);

                    if($taskUser){
                        $taskEntity->addAssignee($taskUser);
                    }
                }

                $taskListId = $task['task_list_id'];

                $taskList = $this->em->getRepository(TaskList::class)->find($taskListId);
                if($taskList){
                    
                    $taskEntity->setTaskList($taskList);
                }

                $this->em->persist($taskEntity);
            }
        }
        $this->em->flush();

        $io->success('Tasks successfuly added in database');

        return Command::SUCCESS;
    }
}
