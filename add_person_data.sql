insert into Person (username,name,name_of_record,job_title, email, alias_email, phone,location,fax,website,publishable,lastApprovedAt,lastApprovedBy,pending) values 
    ('masakoi','Masako K Ikeda', 'Masako K Ikeda', 'Exec Editor','masakoi@hawaii.edu','','808-956-8696','UHP','','',true,'2023-11-08',0, false),
    ('suthers','Daniel D Suthers','Daniel D Suthers','Professor','suthers@hawaii.edu','daniel.suthers@hawaii.edu','808-856-3890','UH Manoa','','',true,'2023-11-08',0, false),
    ('psadow','Peter Joseph Sadowski','Peter J Sadowski','Assistant Professor','psadow@hawaii.edu','peter.sadowski@hawaii.edu','808-956-2023','UH Manoa','','',true,'2023-11-08',0, false),
    ('steph','Stephen Curry','Stephen W Curry','Point Guard','steph30@hawaii.edu','steph.curry@hawaii.edu','808-234-1459','Davidson','','',true,'2023-11-08',0, false),
    ('klay','Klay Thompson','Klay Thompson','Shooting Guard','klay11@hawaii.edu','klay.thompson@hawaii.edu','808-234-1111','Washington','','',true,'2023-11-08',0, false),
    ('draymond','Draymond Green','Draymond Green','Point Forward','dray@hawaii.edu','dray.green@hawaii.edu','808-203-3475','Michigan','','',true,'2023-11-08',0, false),
    ('andre','Andre Iguodala','Andre Iguodala','Forward','iggy@hawaii.edu','iguodala.andre@hawaii.edu','808-234-0329','San Francisco','','',true,'2023-11-08',0, false),
    ('garyp','Gary Payton','Gary Payton II','Shooting Guard','garyp@hawaii.edu','gary.payton@hawaii.edu','808-555-3423','Oregon','','',true,'2023-11-08',0, false);


insert into person_department (person_id,dept_id) values
    (1,1),
    (2,2),
    (3,2),
    (4,5),
    (5,1),
    (6,3);