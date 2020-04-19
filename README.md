# user-management

Steps to install:-
1. Create a DB called "registration".
2. Make sure your mysql credentials are:-
username: root
password: root
3. Import registration.sql into your newly created DB which is named as "registration".
4. If you want to change DB configuration, go to db.php file and change it accordingly.
5. Make sure upload folder has 777 permission. For this one, you can open your terminal and run following command:
chmod -R 777 upload
6. Admin Credential:
username: admin
password: admin
7. Normal user credential:
username: Divya
password: admin

8. Test scenario:-
 8.1 If you login via admin, you would be able to edit/delete any records available.
 8.2 If you login via normal user, you would be able to only edit your data which is available.
