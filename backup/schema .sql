create table Account (
	email varchar(60),
	pass varchar(60),
	fname varchar(60),
	lname varchar(60),
	primary key (email)
);

create table Channel (
	id varchar(60),
	owner varchar(60),
	name varchar(60),
	description text,
	-- contact_info varchar(120),
	-- location varchar(60),
	primary key (id),
	foreign key (owner) references Account(email) ON DELETE CASCADE
);

create table Subscription (
	subscriber varchar(60),
	channel varchar(60),
	primary key (subscriber, channel),
	foreign key (subscriber) references Channel(id) ON DELETE CASCADE,
	foreign key (channel) references Channel(id) ON DELETE CASCADE
);

create table Video (
	id varchar(60) ,
	channel varchar(60),
	title varchar(60),
	location varchar(255),
	description	text,
	private boolean, --  if true => hide , false => show
	restriction boolean,
	upload_date datetime,
	fileName varchar(60),
	primary key (id),
	foreign key (channel) references Channel(id) ON DELETE CASCADE
);

create table Report (
	reporter varchar(60),
	video varchar(60),
	primary key (reporter, video),
	foreign key (reporter) references Channel(id) ON DELETE CASCADE,
	foreign key (video) references Video(id) ON DELETE CASCADE
);

create table VideoComment (
	id int,
	author varchar(60),
	video varchar(60),
	comment text,
	primary key (id, video),
	foreign key (author) references Channel(id) ON DELETE CASCADE,
	foreign key (video) references Video(id) ON DELETE CASCADE
);

create table CommentReply (
	id int,
	parent_id int,
	author varchar(60),
	video varchar(60),
	reply text,
	primary key (id, parent_id, video),
	foreign key (parent_id, video) references VideoComment(id, video) ON DELETE CASCADE,
	foreign key (author) references Channel(id) ON DELETE CASCADE
);

create table CommentLikes (
	viewer varchar(60),
	id int,
	video varchar(60),
	is_liked boolean,
	primary key (viewer, id, video),
	foreign key (id, video) references VideoComment(id, video) ON DELETE CASCADE
);

create table ReplyLikes (
	viewer varchar(60),
	id int,
	parent_id int,
	video varchar(60),
	is_liked boolean,
	primary key (viewer, id, parent_id, video),
	foreign key (id, parent_id, video) references CommentReply(id, parent_id, video) ON DELETE CASCADE
);

create table Views (
	viewer varchar(60),
	video varchar(60),
	primary key (viewer, video),
	foreign key (viewer) references Channel(id) ON DELETE CASCADE,
	foreign key (video) references Video(id) ON DELETE CASCADE
);

create table Likes (
	viewer varchar(60),
	video varchar(60),
	is_liked boolean,
	primary key (viewer, video),
	foreign key (viewer) references Channel(id) ON DELETE CASCADE,
	foreign key (video) references Video(id) ON DELETE CASCADE
);

create table History (
	viewer varchar(60),
	video varchar(60),
	view_datetime datetime,
	primary key (viewer, video, view_datetime) ON DELETE CASCADE,
	foreign key (viewer) references Channel(id) ON DELETE CASCADE,
	foreign key (video) references Video(id) ON DELETE CASCADE
);

create table Playlist (
	id varchar(60),
	owner varchar(60),
	title varchar(60),
	private boolean,
	primary key(id),
	foreign key (owner) references Channel(id) ON DELETE CASCADE
);

create table PlaylistVideos (
	video varchar(60),
	playlist varchar(60),
	playlist_datetime datetime,
	primary key (video, playlist),
	foreign key (video) references Video(id) ON DELETE CASCADE,
	foreign key (playlist) references Playlist(id) ON DELETE CASCADE
);

create table WatchLater (
	viewer varchar(60),
	video varchar(60),
	later_datetime datetime,
	primary key (viewer, video),
	foreign key (viewer) references Channel(id) ON DELETE CASCADE,
	foreign key (video) references Video(id) ON DELETE CASCADE
);