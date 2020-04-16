UE Samples
==========

Functions returns and inputs

function getUser
----------------

returns User

    id-> 6,
    email-> "test@qq.com",
    token-> "156128e06f723821ddec45849c160d400c7ef630",
    nickname-> "user",
    sex-> 2,
    first_name-> "ghgf",
    last_name-> "Mayshun",
    head_img_url-> "http://media.testbest.com.s3.cn-north-1.amazonaws.com.cn/users/6/0645d1ad-81d7-41ec-904d-62866b889255.jpeg",
    account->
        id-> 6,
        balance-> 9,
        minutes_of_tutoring-> 1320,
        minutes_of_group_class-> 1490,
        classes-> 0,
        courses-> 3
    description-> null,
    phone_number-> null,
    university-> null,
    has_img_changed-> false,
    can_book_half_hour-> true,
    has_logged_in-> true,
    school-> 
        id-> 10,
        name-> "Universal Education",
        is_enterprise-> true,
        horizontal_image_url-> "",
        vertical_image_url-> "",
        plan-> 7
    time_zone-> "UTC"

function getMessageThreads
--------------------------

retrieves all conversations

returns array of MessageThreads

    id-> 3,
    created_at-> "2019-01-01T21:13:30.407248Z",
    title-> "TOEFL",
    class_titles-> "IELTS Reading ghgf Mayshun - luke lukey, IELTS Reading ghgf Mayshun - luke lukey, class 1, class2, class 3, class 4, class 5, class 6",
    student->
        avatar-> "http://media.testbest.com.s3.cn-north-1.amazonaws.com.cn/users/6/0645d1ad-81d7-41ec-904d-62866b889255.jpeg",
        name-> "ghgf",
        id-> 6
    tutor->
        avatar-> "",
        name-> "luke lukey",
        id-> 6377
    student_read-> false,
    tutor_read-> false,
    last_message->
        id-> 62,
        created_at-> "2020-01-13T23:43:56.030964Z",
        message-> "hello",
        sender_type-> 0,
        notified-> false,
        seen_at-> null,
        updated_at-> "2020-01-13T23:43:56.592513Z",
        sender->
            avatar-> "http://media.testbest.com.s3.cn-north-1.amazonaws.com.cn/users/6/0645d1ad-81d7-41ec-904d-62866b889255.jpeg",
            name-> "ghgf",
            id-> 6
        attached_file-> "https://s3.amazonaws.com/media.testbest.com/document/4ca8a14a-9785-4b49-95ff-a02420341343.png?response-content-disposition=attachment%3B%20filename%20%3D%22d55d15e0-5259-42bf-a372-b00c0fb96bf4.png%22&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAI3EV6FTWN2MQW6DA%2F20200115%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20200115T185951Z&X-Amz-Expires=3600&X-Amz-SignedHeaders=host&X-Amz-Signature=2feda4c9e26ba35e9392257848458021109c579149da4e88839ae61fc6954d86",
        filename-> "d55d15e0-5259-42bf-a372-b00c0fb96bf4.png"

    id-> 1,
    created_at-> "2018-12-20T18:19:26.094845Z",
    title-> "IELTS",
    class_titles-> "",
    student->
        avatar-> "http://media.testbest.com.s3.cn-north-1.amazonaws.com.cn/users/6/0645d1ad-81d7-41ec-904d-62866b889255.jpeg",
        name-> "ghgf",
        id-> 6
    tutor->
        avatar-> "http://media.testbest.com.s3.cn-north-1.amazonaws.com.cn/users/6/0645d1ad-81d7-41ec-904d-62866b889255.jpeg",
        name-> "Zachary Mauro",
        id-> 96
    student_read-> false,
    tutor_read-> false,
    last_message->
        id-> 3,
        created_at-> "2018-12-20T19:14:33.753392Z",
        message-> "This is a message with emoji ....",
        sender_type-> 0,
        notified-> false,
        seen_at-> null,
        updated_at-> "2018-12-20T19:14:33.756424Z",
        sender->
            avatar-> "http://media.testbest.com.s3.cn-north-1.amazonaws.com.cn/users/6/0645d1ad-81d7-41ec-904d-62866b889255.jpeg",
            name-> "ghgf",
            id-> 6
        attached_file-> null,
        filename-> null

function getMessages
--------------------

retrieves all the messages in a given conversation

sender_type is and enumerated value\
0 = from student\
1 = from teacher\
2 = from system (these are from neither party)

returns array of Message

    "id-> 30,
    "created_at-> "2019-03-08T20:32:16.586222Z",
    "message-> "filename",
    "sender_type-> 0,
    "notified-> false,
    "seen_at-> "2019-03-27T17:37:57.900751Z",
    "updated_at-> "2019-03-27T17:37:57.900885Z",
    "sender-> {
        "avatar-> "http://media.testbest.com.s3.cn-north-1.amazonaws.com.cn/users/6/0645d1ad-81d7-41ec-904d-62866b889255.jpeg",
        "name-> "ghgf",
        "id-> 6
    "attached_file-> null,
    "filename-> null

    "id-> 31,
    "created_at-> "2019-03-08T20:35:12.801560Z",
    "message-> "filename",
    "sender_type-> 0,
    "notified-> false,
    "seen_at-> "2019-10-03T15:59:47.105019Z",
    "updated_at-> "2019-10-03T15:59:47.105136Z",
    "sender-> {
        "avatar-> "http://media.testbest.com.s3.cn-north-1.amazonaws.com.cn/users/6/0645d1ad-81d7-41ec-904d-62866b889255.jpeg",
        "name-> "ghgf",
        "id-> 6
    "attached_file-> "https://s3.amazonaws.com/media.testbest.com/document/6de51420-7dcf-45e7-895e-98b821105fe7.jpe?response-content-disposition=attachment%3B%20filename%20%3D%2201967682.jpg%22&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAI3EV6FTWN2MQW6DA%2F20200115%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20200115T185951Z&X-Amz-Expires=3600&X-Amz-SignedHeaders=host&X-Amz-Signature=54a7dc86c49a53ea44cd28255bf4141cc3a0745a0ff7d5515bd898891efb4bcc",
    "filename-> "01967682.jpg"

function getUnread
------------------

returns int

    1

function getNotify
------------------

returns int

    1

function getCourses
-------------------

retrieves a list of courses the student is enrolled in

returns array of Courses

    id-> 27,
    title-> "Test Courses - IELTS Reading",
    date-> "2019-10-07T18:00:00Z"

function getLessons
------------------

retrieves the list of lessons for a course\
lesson date is when the scheduled class is

returns array of Lessons

      "id-> 50,
      "title-> "class 1",
      "date-> "2019-10-08T01:00:00Z"

      "id-> 51,
      "title-> "class2",
      "date-> "2019-10-10T01:00:00Z"

      "id-> 52,
      "title-> "class 3",
      "date-> "2019-10-13T01:00:00Z"

      "id-> 53,
      "title-> "class 4",
      "date-> "2019-10-15T01:00:00Z"

      "id-> 54,
      "title-> "class 5",
      "date-> "2019-10-17T01:00:00Z"

      "id-> 55,
      "title-> "class 6",
      "date-> "2019-10-20T01:00:00Z"

function getLesson
------------------

retrieves data for a particular lesson

files can be system provided content, tutor provided content, tutor provided assignments and student work\
Homework files are identified by file data containing a due-date

returns stdClass

    files-> array(
        url-> "https://s3.amazonaws.com/media.testbest.com/document/3cb262ce-28ab-4ae7-bda5-edda32d7236a.sh?response-content-disposition=attachment%3B%20filename%20%3D%22vfio-pci-override.sh%22&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAI3EV6FTWN2MQW6DA%2F20200115%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20200115T185951Z&X-Amz-Expires=3600&X-Amz-SignedHeaders=host&X-Amz-Signature=a994b0d998168586c9d20ef0966070e27e2e4b2cc1a7e7d9527ade5b9213efd0",
        filename-> "vfio-pci-override.sh",
        icon->
            code-> "...",
            tag-> "fa-file"
        date-> "2019-10-08T01:00:00Z"

        url-> "https://s3.amazonaws.com/media.testbest.com/document/5d211ce4-dfaf-4a5a-9c77-0a383858eb0f.pdf?response-content-disposition=attachment%3B%20filename%20%3D%22engineered_plans.pdf%22&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAI3EV6FTWN2MQW6DA%2F20200115%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20200115T185951Z&X-Amz-Expires=3600&X-Amz-SignedHeaders=host&X-Amz-Signature=56a04c0c2582e314754126623f032b38634fb453150ea329da13ab6150faaa87",
        filename-> "engineered_plans.pdf",
        icon-> {
            "code-> "...",
            "tag-> "fa-file-pdf"
        },
        date-> "2019-09-28T18:05:49.379660Z",
        due_date-> "2019-10-04T17:00:00Z"

        url-> "https://s3.us-west-1.amazonaws.com/homework.testbest.com/document/student_files/6/ef059f5e-5be4-41b6-ae42-992ba66c5083.jpg?response-content-disposition=attachment%3B%20filename%20%3D%2201967682%2B%25282%2529.jpg%22&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAI3EV6FTWN2MQW6DA%2F20200115%2Fus-west-1%2Fs3%2Faws4_request&X-Amz-Date=20200115T185951Z&X-Amz-Expires=3600&X-Amz-SignedHeaders=host&X-Amz-Signature=56026b1631a3339a374db9a8e1bfbefc9f7815e09d85d12f9b3f6e0e4d7d3612",
        filename-> "01967682 (2).jpg",
        icon-> 
            code-> "...",
            tag-> "fa-file-image"
        date-> "2020-01-14T18:56:00.790702Z"
        
        url-> "https://s3.us-west-1.amazonaws.com/homework.testbest.com/document/student_files/6/f81bed1d-5ba0-43c4-8807-27da154719a7.jpg?response-content-disposition=attachment%3B%20filename%20%3D%2201967682%2B%25281%2529.jpg%22&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAI3EV6FTWN2MQW6DA%2F20200115%2Fus-west-1%2Fs3%2Faws4_request&X-Amz-Date=20200115T185951Z&X-Amz-Expires=3600&X-Amz-SignedHeaders=host&X-Amz-Signature=fe8e8278342be55d014d83a0f830a52551d8c239f4532563b0861beae668a4f0",
        filename-> "01967682 (1).jpg",
        icon->
            code-> "...",
            tag-> "fa-file-image"
        date-> "2020-01-14T18:56:00.790702Z"
    id-> 50,
    course_session_id-> 27,
    title-> "class 1",
    has_homework-> true,
    homework_data->
       lesson_title-> "class 1",
       out_of-> 10,
       due_date-> "2019-10-04T17:00:00Z",
       points-> null,
       total-> "None/10",
       turn_in_date-> "2020-01-14T18:56:00.790702Z"

function getGrades
------------------

retrieves grades for a course

returns stdClass

    lessons-> array(
        homework_data->
            lesson_title-> "class 1",
            out_of-> 10,
            due_date-> "2019-10-04T17:00:00Z",
            points-> null,
            total-> "None/10",
            turn_in_date-> "2020-01-14T18:56:00.790702Z"
        title-> "class 1"

        homework_data->
            lesson_title-> "class2"
        title-> "class2"

        homework_data->
            lesson_title-> "class 3"
        title-> "class 3"
        
        homework_data->
            lesson_title-> "class 4"
        title-> "class 4"
         
        homework_data->
            lesson_title-> "class 5"
        title-> "class 5"
        
        homework_data->
            "lesson_title-> "class 6"
        title-> "class 6"
    )
    overall->
        points-> null,
        out_of-> null,
        total-> "None/None"

function getClassesDetails
-------------------

retrieves class details for a user

returns stdClass

    id-> 148,
    image-> null,
    title-> "class 6",
    assessment_type->
        id-> 1,
        name-> "IELTS",
        color-> "#6DB300"
    subject->
        "id-> 1,
        "name-> "Reading"
    duration-> 120,
    description-> "description 6",
    tutor->
        id-> 6377,
        nickname-> "Lukey Luke",
        sex-> 0,
        first_name-> "luke",
        degree-> "0",
        university-> "ng",
        last_name-> "lukey",
        head_img_url-> "",
        work_year-> 0,
        email-> "luke@mentor.bar",
        description-> "",
        experience-> ""
    reserved_number-> 1,
    status-> 5,
    start_at-> "2019-10-20T01:00:00Z",
    order_status-> 1,
    token-> "feed0480-9013-42e9-afe6-399d3ec246b6",
    class_room_id-> "322069834"
