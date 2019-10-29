<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace Hyperf\Crontab\Mutex;

use Hyperf\Crontab\Crontab;

interface TaskMutex
{
    /**
     * Attempt to obtain a task mutex for the given crontab.
     *
     * @param \Hyperf\Crontab\Crontab $crontab
     * @return bool
     */
    public function create(Crontab $crontab): bool;

    /**
     * Determine if a task mutex exists for the given crontab.
     *
     * @param \Hyperf\Crontab\Crontab $crontab
     * @return bool
     */
    public function exists(Crontab $crontab): bool;

    /**
     * Clear the task mutex for the given crontab.
     *
     * @param \Hyperf\Crontab\Crontab $crontab
     */
    public function remove(Crontab $crontab);
}