#include <iostream>
#include <cstdio>
#include <cstdlib>
using namespace std;

int limit = 10;
int maxBlock = 10;

int main () {
	FILE* f;
	f =fopen("data.txt","w+");
	fprintf(f,"USE Mini-Facebook;\n");

	int block = -1;
	while(block++ < maxBlock-1){
		int I = block*limit + 1;
		int J = I+limit-1;

		// Insert the users
		for(int i = I;i<=J;i++){
			fprintf(f,"INSERT into User(user_id,password,online) values (\"user%d\",\"user%d\",%d);\n",i,i,i%2);
		}
		fprintf(f,"\n");
  //Make users friends with each other
		for(int i = I ; i<=J; i++){
			for(int j=i+1; j<=J; j++){
				fprintf(f,"INSERT into Friends_with(user_id1,user_id2) values (\"user%d\",\"user%d\");\n",i,j);
			}
		}
		fprintf(f,"\n");
  //make users go in relationship with each other
		for(int i = I ; i<I+limit/2; i++){
			fprintf(f,"INSERT into Relationship_with(user_id1,user_id2) values (\"user%d\",\"user%d\");\n",i,J+I-i);
		}
		fprintf(f,"\n");

  //followers
		for(int i = I ; i<=J; i++){
			for(int j=i+1; j<=J; j++){
				fprintf(f,"INSERT into Follow(followed_user_id,followedby_user_id) values (\"user%d\",\"user%d\");\n",i,j);
			}
		}
		fprintf(f,"\n");

  //insert into profile
		for(int i = I; i<=J; i++){
			if(i<=I+limit/2){
				fprintf(f,"INSERT into Profile (`user_id`, `first_name`, `middle_name`, `last_name`, `dob`, `age`, `gender`, `house_no`, `street`, `city`, `state`, `pin`, `country`, `relationship_status`, `graduation_school`, `high_school`, `primary_school`, `phone_no`, `email_id`, `quote`) values (\"user%d\",\"FName%d\",\"MName%d\",\"LName%d\",\"1993-0%d-%d\",20,'MALE',\"houseNO\", \"streetLocation\", \"cityName\", \"stateName\", \"678687\", \"Country\",1,\"my Grad school\", \"my high school\", \"my Primary school\",9829408682, \"email@minifacebook.com\", \"my quote\");\n",
					i,i,i,i,(i%9)+1, (i%30)+1);
			}
			else{
				fprintf(f,"INSERT into Profile (`user_id`, `first_name`, `middle_name`, `last_name`, `dob`, `age`, `gender`, `house_no`, `street`, `city`, `state`, `pin`, `country`, `relationship_status`, `graduation_school`, `high_school`, `primary_school`, `phone_no`, `email_id`, `quote`) values (\"user%d\",\"FName%d\",\"MName%d\",\"LName%d\",\"1993-0%d-%d\",20,'FEMALE',\"houseNO\", \"streetLocation\", \"cityName\", \"stateName\", \"678687\", \"Country\",1,\"my Grad school\", \"my high school\", \"my Primary school\",9829408682, \"email@minifacebook.com\", \"my quote\");\n",
					i,i,i,i,(i%9)+1, (i%30)+1);
			}
		}

		fprintf(f,"\n");

  // insert messages
		int month,day,hour,min,sec;

		for(int i = I; i<=J; i++){
			for(int j = I; j<=J; j++){
				if(i == j) continue;
				else{
					for(int k = 1; k<=10; k++){
						month = rand()%12+1;
						day = rand()%28+1;
						hour =rand()%24;
						min = rand()%60;
						sec = rand()%60;
						fprintf(f,"INSERT INTO Message VALUES (\"user%d\", \"user%d\", '2013-%02d-%02d %02d:%02d:%02d', \"Message#%d from user%d to user%d.\");\n", i, j,month,day,hour,min,sec,k,i,j);
					}
				}
			}
		}
		fprintf(f,"\n");

	//for creating posts
		for(int i =I;i<=J;i++){
			fprintf(f,"INSERT into Post(post_id,likes,data) value (%d,%d,\"this is post %d\");\n",i,limit/2,i);        
		}
		fprintf(f,"\n");

  //for creating post-sender
		for(int i =I;i<=J;i++){
			fprintf(f,"INSERT into Posts(posts_post_id,user_id) value (%d,\"user%d\");\n",i,i);        
		}
		fprintf(f,"\n");

  //likes
		for(int i =I;i<=J;i++){
			for(int j =1;j<=limit/2;j++)
				fprintf(f,"INSERT into Likes(likes_post_id,user_id) value (%d,\"user%d\");\n",i,j*2);        
		}
		fprintf(f,"\n");

  //Post_notification
		for(int i =I;i<=J;i++){
			for(int j =I;j<=J;j++)
				if(j!=i){
					fprintf(f,"INSERT into Post_notification(post_id,receiver_id,seen) value (%d,\"user%d\",0);\n",i,j);        
				}
			}
			fprintf(f,"\n");

  //Comment
			for(int i =I;i<=J;i++){
				int j = rand()%limit+I;
				fprintf(f,"INSERT into Comment(post_id,comment_id,sender_id,data) value (%d,1,\"user%d\",\"Comment1\");\n",i,j);  
				j = rand()%limit+I;
				fprintf(f,"INSERT into Comment(post_id,comment_id,sender_id,data) value (%d,2,\"user%d\",\"Comment2\");\n",i,j);        
				j = rand()%limit+I;
				fprintf(f,"INSERT into Comment(post_id,comment_id,sender_id,data) value (%d,3,\"user%d\",\"Comment3\");\n",i,j);              
			}
			fprintf(f,"\n");

  //Comment_notification
			for(int i =I;i<=J;i++){
				for(int j =I;j<=J;j++)
					if(j!=i){
						fprintf(f,"INSERT into Comment_notification(post_id,comment_id,receiver_id,seen) value (%d,1,\"user%d\",0);\n",i,j);        
						fprintf(f,"INSERT into Comment_notification(post_id,comment_id,receiver_id,seen) value (%d,2,\"user%d\",0);\n",i,j);        
						fprintf(f,"INSERT into Comment_notification(post_id,comment_id,receiver_id,seen) value (%d,3,\"user%d\",0);\n",i,j);        

					}
				}
				fprintf(f,"\n");

  //Event
				for(int i =I;i<=J;i++){
					int j = rand()%limit+1;
					month = rand()%12+1;
					day = rand()%28+1;
					hour =rand()%24;
					min = rand()%60;
					sec = rand()%60;
					fprintf(f,"INSERT into Event(event_id,sender_id,event_name,event_date_time,description,house_no,street,city,state,pin,country) value (%d,\"user%d\",\"Event1\",'2014-%02d-%02d %02d:%02d:%02d' ,\"This is about Event1\",\"House%d1\",\"Street%d1\",\"City%d1\",\"State%d1\",\"%d1\",\"India\");\n",i,i,month,day,hour,min,sec,i,i,i,i,i);              

					j = rand()%limit+1;
					month = rand()%12+1;
					day = rand()%28+1;
					hour =rand()%24;
					min = rand()%60;
					sec = rand()%60;
					fprintf(f,"INSERT into Event(event_id,sender_id,event_name,event_date_time,description,house_no,street,city,state,pin,country) value (%d,\"user%d\",\"Event2\",'2014-%02d-%02d %02d:%02d:%02d' ,\"This is about Event2\",\"House%d2\",\"Street%d2\",\"City%d2\",\"State%d2\",\"%d2\",\"India\");\n",(maxBlock)*limit+i,i,month,day,hour,min,sec,i,i,i,i,i);              

					j = rand()%limit+1;
					month = rand()%12+1;
					day = rand()%28+1;
					hour =rand()%24;
					min = rand()%60;
					sec = rand()%60;
					fprintf(f,"INSERT into Event(event_id,sender_id,event_name,event_date_time,description,house_no,street,city,state,pin,country) value (%d,\"user%d\",\"Event3\",'2014-%02d-%02d %02d:%02d:%02d' ,\"This is about Event3\",\"House%d3\",\"Street%d3\",\"City%d3\",\"State%d3\",\"%d3\",\"India\");\n",(maxBlock*2)*limit+i,i,month,day,hour,min,sec,i,i,i,i,i);              

				}
				fprintf(f,"\n");

  //Event_notification
				for(int i =I;i<=J;i++){
					for(int j =I;j<=J;j++)
						if(j!=i){
							fprintf(f,"INSERT into Event_Notification(event_id,receiver_id,seen) value (%d,\"user%d\",0);\n",i,j);       
							fprintf(f,"INSERT into Event_Notification(event_id,receiver_id,seen) value (%d,\"user%d\",0);\n",i+(maxBlock*limit),j);       
							fprintf(f,"INSERT into Event_Notification(event_id,receiver_id,seen) value (%d,\"user%d\",0);\n",i+(maxBlock*2*limit),j);       

						}
					}

				}




				fclose(f);
				return 0;
			}
