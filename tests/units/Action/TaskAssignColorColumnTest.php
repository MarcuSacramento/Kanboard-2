<?php

require_once __DIR__.'/../Base.php';

use Kanboard\Event\GenericEvent;
use Kanboard\Model\TaskCreation;
use Kanboard\Model\TaskFinder;
use Kanboard\Model\Project;
use Kanboard\Model\Task;
use Kanboard\Action\TaskAssignColorColumn;

class TaskAssignColorColumnTest extends Base
{
    public function testChangeColumn()
    {
        $projectModel = new Project($this->container);
        $taskCreationModel = new TaskCreation($this->container);
        $taskFinderModel = new TaskFinder($this->container);

        $this->assertEquals(1, $projectModel->create(array('name' => 'test1')));
        $this->assertEquals(1, $taskCreationModel->create(array('project_id' => 1, 'title' => 'test')));

        $event = new GenericEvent(array('project_id' => 1, 'task_id' => 1, 'column_id' => 2));

        $action = new TaskAssignColorColumn($this->container);
        $action->setProjectId(1);
        $action->setParam('color_id', 'red');
        $action->setParam('column_id', 2);

        $this->assertTrue($action->execute($event, Task::EVENT_MOVE_COLUMN));

        $task = $taskFinderModel->getById(1);
        $this->assertNotEmpty($task);
        $this->assertEquals('red', $task['color_id']);
    }

    public function testWithWrongCategory()
    {
        $projectModel = new Project($this->container);
        $taskCreationModel = new TaskCreation($this->container);

        $this->assertEquals(1, $projectModel->create(array('name' => 'test1')));
        $this->assertEquals(1, $taskCreationModel->create(array('project_id' => 1, 'title' => 'test')));

        $event = new GenericEvent(array('project_id' => 1, 'task_id' => 1, 'column_id' => 3));

        $action = new TaskAssignColorColumn($this->container);
        $action->setProjectId(1);
        $action->setParam('color_id', 'red');
        $action->setParam('column_id', 2);

        $this->assertFalse($action->execute($event, Task::EVENT_MOVE_COLUMN));
    }
}
