<?php

namespace Kanboard\ServiceProvider;

use Kanboard\Action\TaskAssignColorPriority;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Kanboard\Core\Action\ActionManager;
use Kanboard\Action\CommentCreation;
use Kanboard\Action\CommentCreationMoveTaskColumn;
use Kanboard\Action\TaskAssignCategoryColor;
use Kanboard\Action\TaskAssignCategoryLabel;
use Kanboard\Action\TaskAssignCategoryLink;
use Kanboard\Action\TaskAssignColorCategory;
use Kanboard\Action\TaskAssignColorColumn;
use Kanboard\Action\TaskAssignColorLink;
use Kanboard\Action\TaskAssignColorUser;
use Kanboard\Action\TaskAssignCurrentUser;
use Kanboard\Action\TaskAssignCurrentUserColumn;
use Kanboard\Action\TaskAssignSpecificUser;
use Kanboard\Action\TaskAssignUser;
use Kanboard\Action\TaskClose;
use Kanboard\Action\TaskCloseColumn;
use Kanboard\Action\TaskCreation;
use Kanboard\Action\TaskDuplicateAnotherProject;
use Kanboard\Action\TaskEmail;
use Kanboard\Action\TaskEmailNoActivity;
use Kanboard\Action\TaskMoveAnotherProject;
use Kanboard\Action\TaskMoveColumnAssigned;
use Kanboard\Action\TaskMoveColumnCategoryChange;
use Kanboard\Action\TaskMoveColumnUnAssigned;
use Kanboard\Action\TaskOpen;
use Kanboard\Action\TaskUpdateStartDate;
use Kanboard\Action\TaskCloseNoActivity;

/**
 * Action Provider
 *
 * @package serviceProvider
 * @author  Frederic Guillot
 */
class ActionProvider implements ServiceProviderInterface
{
    /**
     * Register providers
     *
     * @access public
     * @param  \Pimple\Container $container
     * @return \Pimple\Container
     */
    public function register(Container $container)
    {
        $container['actionManager'] = new ActionManager($container);
        $container['actionManager']->register(new CommentCreation($container));
        $container['actionManager']->register(new CommentCreationMoveTaskColumn($container));
        $container['actionManager']->register(new TaskAssignCategoryColor($container));
        $container['actionManager']->register(new TaskAssignCategoryLabel($container));
        $container['actionManager']->register(new TaskAssignCategoryLink($container));
        $container['actionManager']->register(new TaskAssignColorCategory($container));
        $container['actionManager']->register(new TaskAssignColorColumn($container));
        $container['actionManager']->register(new TaskAssignColorLink($container));
        $container['actionManager']->register(new TaskAssignColorUser($container));
        $container['actionManager']->register(new TaskAssignColorPriority($container));
        $container['actionManager']->register(new TaskAssignCurrentUser($container));
        $container['actionManager']->register(new TaskAssignCurrentUserColumn($container));
        $container['actionManager']->register(new TaskAssignSpecificUser($container));
        $container['actionManager']->register(new TaskAssignUser($container));
        $container['actionManager']->register(new TaskClose($container));
        $container['actionManager']->register(new TaskCloseColumn($container));
        $container['actionManager']->register(new TaskCloseNoActivity($container));
        $container['actionManager']->register(new TaskCreation($container));
        $container['actionManager']->register(new TaskDuplicateAnotherProject($container));
        $container['actionManager']->register(new TaskEmail($container));
        $container['actionManager']->register(new TaskEmailNoActivity($container));
        $container['actionManager']->register(new TaskMoveAnotherProject($container));
        $container['actionManager']->register(new TaskMoveColumnAssigned($container));
        $container['actionManager']->register(new TaskMoveColumnCategoryChange($container));
        $container['actionManager']->register(new TaskMoveColumnUnAssigned($container));
        $container['actionManager']->register(new TaskOpen($container));
        $container['actionManager']->register(new TaskUpdateStartDate($container));

        return $container;
    }
}
