drop view if exists person_role_view;

create view person_role_view as
    select Campus.code, Person.id as pid, name_of_record, Person.email as per_email,
    Person.phone as per_phone, Department.name as dept_name,
    role.name as role_name from
    Campus join Department on Campus.id = Department.campus_id join
    Person_Department on Department.id = Person_Department.dept_id
    join Person on Person_Department.person_id = Person.id join
    Person_Role on Person_Role.person_id = Person.id join
    role on role.id = Person_Role.role_id;