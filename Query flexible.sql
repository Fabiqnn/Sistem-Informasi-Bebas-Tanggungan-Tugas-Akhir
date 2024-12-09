USE BebasTanggunganTA
go

SELECT * FROM [USER]
SELECT * FROM [ADMIN] where ID_USER = '1901234567'
delete from [USER]
delete from [ADMIN]
delete from MAHASISWA

SELECT 
    name AS ConstraintName,
    definition AS CheckCondition,
    OBJECT_NAME(parent_object_id) AS TableName
FROM sys.check_constraints
WHERE OBJECT_NAME(parent_object_id) = 'USER';

-- Menambahkan CHECK constraint pada kolom role
ALTER TABLE [user]
ADD CONSTRAINT chk_role CHECK (role IN ('mahasiswa', 'super_adm', 'adm_lt7', 'adm_prodi', 'adm_pustaka'));

ALTER TABLE [user] 
DROP CONSTRAINT chk_role;

-- Menambahkan default value untuk kolom created_at
ALTER TABLE [user]
ADD CONSTRAINT df_created_at DEFAULT CURRENT_TIMESTAMP FOR created_at;

-- menambahkan user --
insert into [USER] (ID_USER, PASS, ROLE)
values 
(1901234567, '123', 'super_adm'),
(1907899870, '234', 'adm_lt7'),
(1904566542, '345', 'adm_pustaka'),
(1902344321, '456', 'adm_prodi'),
(2341720002, '567', 'mahasiswa'),
(2341720034, '678', 'mahasiswa'),
(2341720171, '789', 'mahasiswa'),
(2341720095, '890', 'mahasiswa'),
(2341720170, '901', 'mahasiswa')

/*==============================================================*/
/* Data Admin                                   */
/*==============================================================*/
INSERT INTO ADMIN (NIP, ID_USER, NAMA, EMAIL, NOWA_ADMIN, PATH_FOTO_PROFIL) VALUES
('1901234567', 1901234567, 'Bagus', 'admin@universitas.ac.id', '081234567890', NULL),
('1907899870', 1907899870, 'Sinta', 'admin.prodi@universitas.ac.id', '081234567891', NULL),
('1904566542', 1904566542, 'Sindi', 'admin.pustaka@universitas.ac.id', '081234567892', NULL),
('1902344321', 1902344321, 'Didik', 'admin.jurusan@universitas.ac.id', '081234567893', NULL);

/*==============================================================*/
/* Data Mahasiswa                                  */
/*==============================================================*/ 
INSERT INTO MAHASISWA(NIM, NAMA_MHS, PRODI, ANGKATAN, JENJANG_PENDIDIKAN, PATH_PROFIL_MHS, EMAIL_MHS, NO_WA_MHS, ID_USER) VALUES
('2341720002', 'Muhammad Syahrul Gunawan', 'D4 Sistem Informasi Bisnis ( D4-SIB)', 2024, 'D4', NULL, 'syahrulgunawann41@gmail.com', '082333048533', 2341720002),
('2341720034', 'Kibar Mustofa', 'D2 Pengembangan Perangkat (Piranti) Lunak Situs (D2-PPLS)', 2024, 'D2', NULL, 'kibarmustofa1511@gmail.com','085843657583', 2341720034),
('2341720171', 'Aaisyah Nursalsabiil N.P', 'D4 Teknik Informatika ( D4-TI)', 2024, 'D2', NULL, 'aisyahnursalsabiil@gmail.com', '081358848358', 2341720171),
('2341720095', 'Aril Ibbet Ardana Putra', 'D4 Teknik Informatika ( D4-TI)', 2024, 'D4', NULL, 'arilardana111@gmail.com', '085156489059', 2341720095),
('2341720170', 'Fabian Hasbillah ', 'D4 Sistem Informasi Bisnis ( D4-SIB )', 2024, 'D4', NULL,'Fabian.hasbillah@gmail.com', '0895412261150', 2341720170);


SELECT * FROM [USER] join [ADMIN] on [user].ID_USER = [ADMIN].ID_USER
where [ADMIN].ID_USER = '1901234567'

SELECT * FROM MAHASISWA
SELECT * FROM ADMIN
select * FROM [USER]
SELECT * FROM [USER] join [ADMIN] on [USER].ID_USER = [ADMIN].ID_USER;

delete From [USER] where ID_USER = '1909877654'
delete FROM [ADMIN] WHERE ID_USER = '1909877654'

INSERT INTO [USER] (ROLE, PASS, ID_USER)
VALUES ('adm_lt7','8765', '1909877654')
 
 INSERT INTO [ADMIN] (NAMA, NIP, ID_USER)
 values	('Vian Dwiangga', '1909877654', '1909877654')

ALTER TABLE [ADMIN] NOCHECK CONSTRAINT FK_ADMIN_RELATIONS_USER;

-- Update tabel USER
UPDATE [USER] 
SET ROLE = 'super_adm', 
    PASS = '123'
WHERE ID_USER = '1901234567';

-- Update tabel ADMIN
UPDATE [ADMIN]
SET NAMA = 'Bagus', 
    NIP = '1901234567', 
    ID_USER = '1901234567'
WHERE NIP = '1901234568';

-- Aktifkan kembali constraint
ALTER TABLE [ADMIN] CHECK CONSTRAINT FK_ADMIN_RELATIONS_USER;

SELECT 
	MAHASISWA.NAMA_MHS,
	[USER].ID_USER, 
    [USER].PASS,
	MAHASISWA.ANGKATAN,
	MAHASISWA.PRODI
FROM [USER] JOIN MAHASISWA ON [USER].ID_USER = MAHASISWA.ID_USER
WHERE MAHASISWA.ID_USER = '2341720002'

INSERT INTO [USER] (ROLE, PASS, ID_USER)
VALUES ('mahasiswa', '12345', '2341123987');

INSERT INTO MAHASISWA (NAMA_MHS, NIM, ID_USER, ANGKATAN, PRODI)
VALUES ('Vian Dwiangga', '2341123987', '2341123987', '2023', 'Pengembangan Perangkat (Piranti) Lunak Situs (D2-PPLS)');

delete From [USER] where ID_USER = '2341123987'
delete FROM [MAHASISWA] WHERE ID_USER = '2341123987'