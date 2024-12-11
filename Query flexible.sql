USE BebasTanggunganTA
go

CREATE TABLE [USER] (
	ID_USER varchar(10) primary key not null,
	PASS varchar(50) not null,
	ROLE varchar(20),
	CREATED_AT datetime,
	UPDATED_AT datetime
)
go

CREATE TABLE [ADMIN] (
	NIP varchar(10) primary key not null,
	NAMA_ADM varchar(100),
	EMAIL_ADM varchar(50),
	NO_WA_ADM varchar(16),
	FOTO_ADM varchar(255)
)
go

CREATE TABLE MAHASISWA (
	NIM VARCHAR(10) PRIMARY KEY NOT NULL,
	PRODI varchar(100),
	ANGKATAN int, 
	NAMA_MHS varchar(100),
	NO_WA_MHS varchar(16),
	EMAIL_MHS varchar(50),
	FOTO_MHS varchar(255)
)
go

CREATE TABLE VERIFIKASI (
	ID_VERIFIKASI int IDENTITY(1,1) PRIMARY KEY NOT NULL,
	STATUS_VERIFIKASI varchar(20),
	WAKTU_VERIFIKASI datetime,
	catatan text
)
go

CREATE TABLE FORM_TA (
	ID_FORM_TA int IDENTITY(1,1) PRIMARY KEY NOT NULL,
	FILE_LAPORAN_TA varchar(255) not null,
	PROGRAM_TA varchar(255) not null, 
	PUBLIKASI varchar(255) not null,
	FORM_TA_CREATED datetime,
	FORM_TA_UPDATED datetime
)
go

CREATE TABLE FORM_PRODI (
	ID_FORM_PRODI int IDENTITY(1,1) PRIMARY KEY NOT NULL,
	BUKU_SKRIPSI varchar(255) not null,
	LAPORAN_PKL varchar(255) not null,
	BEBAS_KOMPEN varchar(255) not null,
	FORM_PRODI_CREATED datetime,
	FORM_PRODI_UPDATED datetime
)
go

CREATE TABLE FORM_PUSTAKA (
	ID_FORM_PUSTAKA int IDENTITY(1,1) PRIMARY KEY NOT NULL,
	JUDUL_KARYA_ILMIAH varchar(100) not null,
	TAHUN_KARYA_ILMIAH int not null,
	TANGGAL_UJIAN_SKRIPSI date,
	TANGGAL_YUDISIUM date,
	FILE_BEBAS_KOMPEN varchar(255) not null,
	FILE_ABSTRAK varchar(255) not null,
	BAB_1 varchar(255) not null,
	BAB_2 varchar(255) not null,
	BAB_3 varchar(255) not null,
	BAB_4 varchar(255) not null,
	BAB_5 varchar(255) not null,
	BAB_6 varchar(255) not null,
	BAB_7 varchar(255) not null,
	FILE_DAFTAR_PUSTAKA varchar(255) not null,
	FILE_LAMPIRAN varchar(255) not null,
	FILE_KOMPILASI_LAPORAN_AKHIR varchar(255) not null,
	LINK_JURNAL varchar(255),
	FILE_SOFTCOPY_JURNAL varchar(255),
	IZIN_MENGOLAH varchar(5) not null,
	RESI_PENGIRIMAN_SKRIPSI varchar(255) not null,
	PENYERAHAN_SKRIPSI varchar(40) not null,
	FORM_PUSTAKA_CREATED datetime,
	FORM_PUSTAKA_UPDATED datetime
)
go

--constraint--

ALTER TABLE [user]
ADD CONSTRAINT chk_role CHECK (role IN ('mahasiswa', 'super_adm', 'adm_lt7', 'adm_prodi', 'adm_pustaka'));
go

ALTER TABLE [ADMIN]
ADD ID_USER varchar(10) not null UNIQUE
go

AlTER TABLE [ADMIN]
ADD CONSTRAINT fk_admin_user FOREIGN KEY (ID_USER) REFERENCES [USER](ID_USER)
go

ALTER TABLE [MAHASISWA]
ADD ID_USER varchar(10) not null UNIQUE
go

AlTER TABLE [MAHASISWA]
ADD CONSTRAINT fk_mahasiswa_user FOREIGN KEY (ID_USER) REFERENCES [USER](ID_USER)
go

ALTER TABLE VERIFIKASI
ADD NIP varchar(10) 
go

ALTER TABLE VERIFIKASI 
ADD CONSTRAINT fk_verifikasi_admin FOREIGN KEY (NIP) REFERENCES [ADMIN](NIP)
go

-- form ta--

ALTER TABLE FORM_TA
ADD ID_VERIFIKASI int null UNIQUE
go

ALTER TABLE FORM_TA
ADD NIM varchar(10) not null UNIQUE
go

ALTER TABLE FORM_TA 
ADD CONSTRAINT fk_formTA_verifikasi FOREIGN KEY (ID_VERIFIKASI) REFERENCES VERIFIKASI(ID_VERIFIKASI)
go

ALTER TABLE FORM_TA 
ADD CONSTRAINT fk_formTA_mahasiswa FOREIGN KEY (NIM) REFERENCES MAHASISWA(NIM)
go

-- form prodi --

ALTER TABLE FORM_PRODI
ADD ID_VERIFIKASI int null UNIQUE
go

ALTER TABLE FORM_PRODI
ADD NIM varchar(10) not null UNIQUE
go

ALTER TABLE FORM_PRODI
ADD CONSTRAINT fk_formProdi_verifikasi FOREIGN KEY (ID_VERIFIKASI) REFERENCES VERIFIKASI(ID_VERIFIKASI)
go

ALTER TABLE FORM_PRODI
ADD CONSTRAINT fk_formProdi_mahasiswa FOREIGN KEY (NIM) REFERENCES MAHASISWA(NIM)
go

-- form pustaka --

ALTER TABLE FORM_PUSTAKA
ADD ID_VERIFIKASI int null UNIQUE
go

ALTER TABLE FORM_PUSTAKA
ADD NIM varchar(10) not null UNIQUE
go

ALTER TABLE FORM_PUSTAKA
ADD CONSTRAINT fk_formPustaka_verifikasi FOREIGN KEY (ID_VERIFIKASI) REFERENCES VERIFIKASI(ID_VERIFIKASI)
go

ALTER TABLE FORM_PUSTAKA
ADD CONSTRAINT fk_formPustaka_mahasiswa FOREIGN KEY (NIM) REFERENCES MAHASISWA(NIM)
go

-------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------


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
INSERT INTO [ADMIN] (NIP, ID_USER, NAMA_ADM, EMAIL_ADM, NO_WA_ADM, FOTO_ADM) VALUES
('1901234567', 1901234567, 'Bagus', 'admin@universitas.ac.id', '081234567890', NULL),
('1907899870', 1907899870, 'Sinta', 'admin.prodi@universitas.ac.id', '081234567891', NULL),
('1904566542', 1904566542, 'Sindi', 'admin.pustaka@universitas.ac.id', '081234567892', NULL),
('1902344321', 1902344321, 'Didik', 'admin.jurusan@universitas.ac.id', '081234567893', NULL);

/*==============================================================*/
/* Data Mahasiswa                                  */
/*==============================================================*/ 
INSERT INTO MAHASISWA(NIM, NAMA_MHS, PRODI, ANGKATAN, FOTO_MHS, EMAIL_MHS, NO_WA_MHS, ID_USER) VALUES
('2341720002', 'Muhammad Syahrul Gunawan', 'D4 Sistem Informasi Bisnis ( D4-SIB)', 2024, NULL, 'syahrulgunawann41@gmail.com', '082333048533', 2341720002),
('2341720034', 'Kibar Mustofa', 'D2 Pengembangan Perangkat (Piranti) Lunak Situs (D2-PPLS)', 2024, NULL, 'kibarmustofa1511@gmail.com','085843657583', 2341720034),
('2341720171', 'Aaisyah Nursalsabiil N.P', 'D4 Teknik Informatika ( D4-TI)', 2024, NULL, 'aisyahnursalsabiil@gmail.com', '081358848358', 2341720171),
('2341720095', 'Aril Ibbet Ardana Putra', 'D4 Teknik Informatika ( D4-TI)', 2024, NULL, 'arilardana111@gmail.com', '085156489059', 2341720095),
('2341720170', 'Fabian Hasbillah ', 'D4 Sistem Informasi Bisnis ( D4-SIB )', 2024, NULL,'Fabian.hasbillah@gmail.com', '0895412261150', 2341720170);


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
delete FROM [MAHASISWA] WHERE ID_USER = '2341123987';

SELECT * FROM FORM_TA join MAHASISWA ON FORM_TA.NIM = MAHASISWA.NIM WHERE FORM_TA.NIM = '2341720170'
SELECT * FROM FORM_PRODI
SELECT * FROM FORM_TA join MAHASISWA on FORM_TA.NIM = MAHASISWA.NIM
SELECT * FROM FORM_PUSTAKA

delete from VERIFIKASI where nip = '1907899870'
update FORM_TA
SET ID_VERIFIKASI = null
WHERE NIM = '2341720170'

ALTER TABLE [FORM_PUSTAKA]
ADD PENYERAHAN_SKRIPSI varchar(40) not null