<?php

namespace PerfectOblivion\MsGraph\AdminResources;

use PerfectOblivion\MsGraph\Facades\MsGraphAdmin;
use Exception;

class Files extends MsGraphAdmin
{
    private $userId;

    public function userid($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    public function getDrives()
    {
        if ($this->userId == null) {
            throw new Exception("userId is required.");
        }

        return MsGraph::get('users/'.$this->userId.'/drives');
    }

    public function downloadFile($id)
    {
        if ($this->userId == null) {
            throw new Exception("userId is required.");
        }

        $id = MsGraph::get('users/'.$this->userId.'/drive/items/'.$id);

        return redirect()->away($id['@microsoft.graph.downloadUrl']);
    }

    public function deleteFile($id)
    {
        if ($this->userId == null) {
            throw new Exception("userId is required.");
        }

        return MsGraph::delete('users/'.$this->userId.'/drive/items/'.$id);
    }
}
