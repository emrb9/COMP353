<?php

class scheduleController extends Controller
{
    public function index()
    {
        $schedule = $this->model('Schedule');
        $schedules = $schedule->getAllSchedules();
        $this->view('Schedule/Index', $schedules);
    }

    public function add()
    {
        if (isset($_POST['action'])) {
            $schedule = $this->model('Schedule');

            // Basic input validation example
            if (!empty($_POST['SSN']) && !empty($_POST['address']) && !empty($_POST['postalCode'])&& !empty($_POST['startTime'])&& !empty($_POST['date'])) {
                // Sanitizing inputs as an extra layer of security
                $schedule->SSN = filter_var($_POST['SSN'], FILTER_SANITIZE_STRING);
                $schedule->address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
                $schedule->postalCode = filter_var($_POST['postalCode'], FILTER_SANITIZE_STRING);
                $schedule->startTime = filter_var($_POST['startTime'], FILTER_SANITIZE_STRING);
                $schedule->endTime = filter_var($_POST['endTime'], FILTER_SANITIZE_STRING);
                $schedule->date = filter_var($_POST['date'], FILTER_SANITIZE_STRING);

                if($schedule->addschedule()) {
                    header("Location: /Schedule?message=Addition+Successful");
                } else {
                    header("Location: /Schedule/Addschedule?error=Addition+Failed");
                }
            } else {
                header("Location: /Schedule/Addschedule?error=Validation+Failed");
            }
            exit();
        }
        $this->view('Schedule/Addschedule');
    }

    public function edit() {
        // Check if the form was submitted via POST with the required data
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['SSN']) && isset($_POST['address'])&& isset($_POST['postalCode'])&& isset($_POST['startTime'])&& isset($_POST['date'])) {
            // Sanitize the input for security
            $SSN = filter_var($_POST['SSN'], FILTER_SANITIZE_STRING);
            $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
            $postalCode = filter_var($_POST['postalCode'], FILTER_SANITIZE_STRING);
            $startTime = filter_var($_POST['startTime'], FILTER_SANITIZE_STRING);
            $date = filter_var($_POST['date'], FILTER_SANITIZE_STRING);
            
    
            // Fetch the schedule's details using the provided address and postalCode
            $scheduleModel = $this->model('Schedule');
            $schedule = $scheduleModel->getscheduleById($SSN,$address, $postalCode, $startTime, $date);
    
            if ($schedule) {
                // If the schedule is found, pass its details to the view to pre-fill the edit form
                $this->view('Schedule/Editschedule', ['schedule' => $schedule]);
            } else {
                // Redirect with an error if the schedule cannot be found
                header('Location: /Schedule?error=Schedule+Not+Found');
                exit();
            }
        } else {
            // Redirect or handle the case where the necessary POST data wasn't provided
            header('Location: /Schedule?error=Missing+Data');
            exit();
        }
    }   

    public function editAction() {
        if (isset($_POST['action'])) {
            $scheduleModel = $this->model('Schedule');
    
            // Retrieve all the form data
            $SSN = filter_var($_POST['SSN'], FILTER_SANITIZE_STRING);
            $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
            $postalCode = filter_var($_POST['postalCode'], FILTER_SANITIZE_STRING);
            $startTime = filter_var($_POST['startTime'], FILTER_SANITIZE_STRING);
            $endTime = filter_var($_POST['endTime'], FILTER_SANITIZE_STRING);
            $date = filter_var($_POST['date'], FILTER_SANITIZE_STRING);

            // Attempt to update the schedule
            if ($scheduleModel->updateschedule($SSN, $address, $postalCode, $startTime, $endTime, $date)) {
                header("Location: /Schedule?message=Update+Successful");
            } else {
                header("Location: /Schedule?error=Update+Failed");
            }
            exit();
        }
    }
    

public function delete()
{
    if (isset($_POST['SSN']) && isset($_POST['address']) && isset($_POST['postalCode']) && isset($_POST['startTime']) && isset($_POST['date'])) {
            $SSN = filter_var($_POST['SSN'], FILTER_SANITIZE_STRING);
            $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
            $postalCode = filter_var($_POST['postalCode'], FILTER_SANITIZE_STRING);
            $startTime = filter_var($_POST['startTime'], FILTER_SANITIZE_STRING);
            $date = filter_var($_POST['date'], FILTER_SANITIZE_STRING);

        $schedule = $this->model('Schedule');
        $schedule->SSN = $SSN;
        $schedule->address = $address;
        $schedule->postalCode = $postalCode;
        $schedule->startTime = $startTime;
        $schedule->date = $date;

        if ($schedule->deleteschedule()) {
            header("Location: /Schedule?message=Deletion+Successful");
        } else {
            header("Location: /Schedule?error=Deletion+Failed");
        }
    } else {
        // Redirect or handle the error if address or postalCode aren't provided
        header("Location: /Schedule?error=Missing+Data");
    }
    exit();
}
}

?>