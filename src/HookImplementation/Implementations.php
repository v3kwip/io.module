<?php

namespace Drupal\io\HookImplementation;

class Implementation
{

    private $hookEntityInfo;
    private $hookUserCancel;
    private $hookCron;

    /**
     * @return HookEntityInfo
     */
    public function getHookEntityInfo()
    {
        if (NULL === $this->hookEntityInfo) {
            $this->hookEntityInfo = new HookEntityInfo();
        }
        return $this->hookEntityInfo;
    }

    /**
     * @return HookUserCancel
     */
    public function getHookUserCancel()
    {
        if (NULL == $this->hookUserCancel) {
            $this->hookUserCancel = new HookUserCancel();
        }
        return $this->hookUserCancel;
    }

    /**
     * @return HookCron
     */
    public function getHookCron()
    {
        if (NULL === $this->hookCron) {
            $this->hookCron = new HookCron();
        }
        return $this->hookCron;
    }

    public function setHookEntityInfo($hookEntityInfo)
    {
        $this->hookEntityInfo = $hookEntityInfo;
        return $this;
    }

    public function setHookUserCancel($hookUserCancel)
    {
        $this->hookUserCancel = $hookUserCancel;
        return $this;
    }

    public function setHookCron($hookCron)
    {
        $this->hookCron = $hookCron;
        return $this;
    }

}
