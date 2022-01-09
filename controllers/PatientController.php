<?php

//Controller interact with database and Views.
//Calling database methods controller pick data from database
//After picking data from database controller send data to appropriate View calling renderView method from Router class
//Also controller access get access to database from parameter of class Router(Router class contain instance of Router class)

namespace app\controllers;

use app\Router;

class PatientController
{
    public function get(Router $router)  //get is name of action of our PatientController
    {
        $patients = $router->db->getPatients();
        $router->renderView('patients',[  //home is name of view.Because home is directly in folder view we don't have for example patients/home or something similar
            'patients' => $patients   //patients will be name of variable for accessing in our view
        ]);
    }
}