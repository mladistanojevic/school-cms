<?php

function isLogged()
{
    if (isset($_SESSION['user'])) {
        return true;
    }
    return false;
}

function access($rank = 'student')
{
    if (!isLogged()) {
        return false;
    }

    $loggedUserRank = $_SESSION['user']->rank;
    if (!$loggedUserRank) {
        return false;
    }

    $RANK['super_admin'] =  ['super_admin', 'admin', 'lecturer', 'reception', 'student'];
    $RANK['admin']       =  ['admin', 'lecturer', 'reception', 'student'];
    $RANK['lecturer']    =  ['lecturer', 'reception', 'student'];
    $RANK['reception']   =  ['reception', 'student'];
    $RANK['student']     =  ['student'];

    if (in_array($rank, $RANK[$loggedUserRank])) {
        return true;
    }

    return false;
}
