package com.punemetro.activities;

import org.json.JSONException;
import org.json.JSONObject;

import com.example.androidhive.R;
import com.punemetro.activities.library.UserFunctions;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

public class Chngpass extends Activity {
	
	private Button cncl,chng;
	public String value,password,nwpassword,cpasw,reply;
	public EditText pass,nwpass,cpass;
	
	public void onCreate(Bundle savedInstanceState)
	{
        super.onCreate(savedInstanceState);
        setContentView(R.layout.chngpass);
        Bundle extras = getIntent().getExtras();
        if (extras != null)
		{
		    value = extras.getString("user");
		}
        
        pass = (EditText) findViewById(R.id.editText1);
        nwpass = (EditText) findViewById(R.id.editText2);
        cpass = (EditText) findViewById(R.id.editText3);
        
       
        
        chng = (Button) findViewById(R.id.button1);
        
        chng.setOnClickListener(new View.OnClickListener() {
			 public void onClick(View v) {
				 	password = pass.getText().toString();
			        nwpassword = nwpass.getText().toString();
			        cpasw = cpass.getText().toString();
			    if(nwpassword.length() > 7 && nwpassword.matches("^(?=.*\\d)(?=.*[A-Z])(?=.*[a-z])[^\\W_]{8,14}$"))
				{
        			if(nwpassword.equals(cpasw))
        			{
        					UserFunctions userFunction = new UserFunctions();
        					JSONObject json= userFunction.change_password(value,password,nwpassword);
        					
        					try {
        						JSONObject json_user = json.getJSONObject("rep");
        						
        					     reply = json_user.getString("msg");
        						
        					} catch (JSONException e) {
        						// TODO Auto-generated catch block
        						e.printStackTrace();
        					}
        					if(reply.equals("error"))
        					{
        						Toast.makeText(Chngpass.this,
            							" Old Password is Wrong ",
            								Toast.LENGTH_SHORT).show();
        						
        					}
        					else
        					{
        					Toast.makeText(Chngpass.this,
        							" PASSWORD CHANGED SUCCESSFULLY ",
        								Toast.LENGTH_SHORT).show();
        			        
        			        Intent home = new Intent(getApplicationContext(),Page.class);
        			        home.putExtra("user", value);
        					startActivity(home);
        					}
        			}
        			else
        			{
        				Toast.makeText(Chngpass.this,
                				" PASSWORD DO NOT MATCH ",
                					Toast.LENGTH_SHORT).show();
        			}
        	}
        	else
        	{
        		Toast.makeText(Chngpass.this,
        				"Password - 1.1.Length Between 8-14" +
								"2.Must Contain a Capital Letter"+
								"3.Must Contain a Number "+
								"4.No Special Characters",
        					Toast.LENGTH_SHORT).show();
        	}
		}
			  
     });
        
        cncl = (Button) findViewById(R.id.button2);
        
        cncl.setOnClickListener(new View.OnClickListener() {
			 public void onClick(View v) {
				 
				 Intent home = new Intent(getApplicationContext(),Page.class);
				 home.putExtra("user", value);
				 startActivity(home);
			 }
			  
		});
        
	}

}
