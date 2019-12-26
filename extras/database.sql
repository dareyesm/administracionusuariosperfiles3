create table if not exists users(

idUsers INT unsigned not null auto_increment,
loginUsers VARCHAR(15) character set utf8 collate utf8_spanish_ci not null,
passUsers VARCHAR(10) character set utf8 collate utf8_spanish_ci not null,
idprofile INT not null,
emailUser VARCHAR(50) character set utf8 collate utf8_spanish_ci not null,
idActiveCode BLOB character set utf8 collate utf8_spanish_ci,
path_imgUser LONGTEXT character set utf8 collate utf8_spanish_ci,
idexistindb INT not null,
primary key(idUsers)

)engine=myisam character set utf8 collate utf8_spanish_ci;

create table if not exists profiles(
	idProfile INT unsigned not null auto_increment,
	codeProfi VARCHAR(10) character set utf8 collate utf8_spanish_ci not null,
	nameProfi VARCHAR(10) character set utf8 collate utf8_spanish_ci not null,
	descProfi VARCHAR(250) character set utf8 collate utf8_spanish_ci not null,
	dateProfi DATE not null,
	statusPro SET('Enabled', 'Disabled') not null,
	primary key(idProfile)
)engine=myisam character set utf8 collate utf8_spanish_ci;

create table if not exists user_pro(
	idUserPro INT unsigned not null auto_increment,
	idProfile INT not null,
	idUsers INT not null,
	primary key(idUserPro),
	constraint fk1 foreign key(idProfile) references profiles(idProfile),
	constraint fk2 foreign key(idUsers) references users(idUsers)
)engine=myisam character set utf8 collate utf8_spanish_ci;

create table if not exists modules(
	idmodule INT unsigned not null auto_increment,
	codeModule VARCHAR(10) character set utf8 collate utf8_spanish_ci not null,
	nameModule VARCHAR(20) character set utf8 collate utf8_spanish_ci not null,
	descModule VARCHAR(250) character set utf8 collate utf8_spanish_ci not null,
	dateModule DATE not null,
	statusModu SET('Enabled', 'Disabled') not null,
	primary key(idmodule)
)engine=myisam character set utf8 collate utf8_spanish_ci;

create table if not exists mod_profile(
	idmod_prof INT unsigned not null auto_increment,
	idmodule INT,
	idProfile INT,
	primary key(idmod_prof),
	constraint fk1 foreign key (idmodule) references modules(idmodule),
	constraint fk2 foreign key (idProfile) references profiles(idPrfile)	
)engine=myisam character set utf8 collate utf8_spanish_ci;

create table if not exists roles(
	idRole INT unsigned not null auto_increment,
	codeRole VARCHAR(10) character set utf8 collate utf8_spanish_ci not null,
	nameRole VARCHAR(10) character set utf8 collate utf8_spanish_ci not null,
	descRole LONGTEXT character set utf8 collate utf8_spanish_ci not null,
	statRole set('Enabled', 'Disabled') not null,
	primary key(idRole)
)engine=myisam character set utf8 collate utf8_spanish_ci;

create table if not exists role_user(
	idRolUs INT unsigned not null auto_increment,
	idUsers INT not null,
	idRole INT not null,
	constraint fk1 foreign key(idUsers) references users(idUsers),
	constraint fk2 foreign key(idRole) references roles(idRole),
	primary key(idRolUs)
)engine=myisam character set utf8 collate utf8_spanish_ci;

create table if not exists menu(
	idmenu INT unsigned NOT NULL auto_increment,
	nameMenu VARCHAR(20) character set utf8 collate utf8_spanish_ci,
	linkMenu LONGTEXT character set utf8 collate utf8_spanish_ci,
	descMenu LONGTEXT character set utf8 collate utf8_spanish_ci,
	idModule INT not null,
	constraint fk1 foreign key(idModule) references modules(idmodule),
	primary key(idmenu)
)engine=myisam character set utf8 collate utf8_spanish_ci;