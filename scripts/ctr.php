$ctr++;
        if (isset($_GET['amount'])) {
            if ($ctr > $_GET['amount']) {
                break;
            }
        }