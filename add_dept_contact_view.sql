drop view if exists dept_contact_view;

create view dept_contact_view as
    select * from person_role_view where
    role_name='Primary' or role_name='Secondary';