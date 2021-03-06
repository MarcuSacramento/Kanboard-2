<?php

namespace Kanboard\Filter;

use Kanboard\Core\Filter\FilterInterface;
use Kanboard\Model\Project;
use Kanboard\Model\Task;

/**
 * Filter tasks by project
 *
 * @package filter
 * @author  Frederic Guillot
 */
class TaskProjectFilter extends BaseFilter implements FilterInterface
{
    /**
     * Get search attribute
     *
     * @access public
     * @return string[]
     */
    public function getAttributes()
    {
        return array('project');
    }

    /**
     * Apply filter
     *
     * @access public
     * @return FilterInterface
     */
    public function apply()
    {
        if (is_int($this->value) || ctype_digit($this->value)) {
            $this->query->eq(Task::TABLE.'.project_id', $this->value);
        } else {
            $this->query->ilike(Project::TABLE.'.name', $this->value);
        }

        return $this;
    }
}
