#### Github link



## DataBase Schema
    HOST_NAME: localhost
    USER_NAME: root
    PASSWORD:
    DATABASE_NAME: to_do_list
    
## Table task schema
<!-- I have added the status field as boolean which give the  status if the task weather completed or not  -->
    CREATE TABLE task( 
    id int  AUTO_INCREMENT PRIMARY KEY,
    title varchar(255),
    description text,
    status boolean,
    created_at datetime,
    updated_at datetime
    )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

## HOW TO RUN IT
1-Download the project from the github repository
2-Place the downloaded project into xampp/htdocs
3-Start xampp and open localhost/TO_DO_LIST on your navigatore 


## HOW IT WORK
This is a To Do List project that contains basically the CRUD functionnalities that (Create, Read, Update and Delete)
it permits us to create new task and it also two tables one showing the completed task and the other one having the incomplete task. it also have field validation before submission.
