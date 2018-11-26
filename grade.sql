create table grade(

grade varchar(100) not NULL

);
INSERT INTO grade (grade) VALUES ('A1'), ('A2'), ('B1'), ('B2'),  ('C1'), ('C2'), ('D1'), ('D2');
alter table academic 
add column grade VARCHAR(100);

select * from grade;
