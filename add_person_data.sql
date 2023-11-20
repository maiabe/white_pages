insert into Person (username,name,name_of_record,job_title, email, alias_email, phone,location,fax,website,publishable,lastApprovedAt,lastApprovedBy) values 
    ('masakoi','Masako K Ikeda', 'Masako K Ikeda', 'Exec Editor','masakoi@hawaii.edu','','808-956-8696','UHP','','',true,'2023-11-08',0),
    ('suthers','Daniel D Suthers','Daniel D Suthers','Professor','suthers@hawaii.edu','daniel.suthers@hawaii.edu','808-856-3890','UH Manoa','','',true,'2023-11-08',0),
    ('psadow','Peter Joseph Sadowski','Peter J Sadowski','Assistant Professor','psadow@hawaii.edu','peter.sadowski@hawaii.edu','808-956-2023','UH Manoa','','',true,'2023-11-08',0);


insert into person_department (person_id,dept_id) values
    (1,1),
    (2,2),
    (3,2);