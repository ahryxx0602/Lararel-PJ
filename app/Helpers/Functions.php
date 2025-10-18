<?php

use App\Models\Groups;

function getAllGroups()
{
              $group = new Groups();
              return $group->getAllGroups();
}
