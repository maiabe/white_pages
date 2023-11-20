drop view if exists dept_person_view;

create view dept_person_view as 
    select Person.id as pid, username,Person.name as person_name, Department.id as dept_id, Department.name as dept_name, Campus.code
    from Person join person_department on Person.id=person_department.person_id join Department on person_department.dept_id=Department.id
    join Campus on Department.campus_id=Campus.id;