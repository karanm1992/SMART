package com.punemetro.activities;

import java.io.InputStream;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import com.example.androidhive.R;
import com.punemetro.activities.library.UserFunctions;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

public class Page1 extends Activity
{
	TextView test;
	String [] result1 = new String[10];
	String jsonResult;
	int i = 0;
	InputStream isr = null;
	JSONArray jsonResponse;
	private Button prcd,hme;
	public static String src,dest,value;
	
	String result = null;
    InputStream is = null;
    StringBuilder sb=null;
 
    

	protected void onCreate(Bundle savedInstanceState)
	{
		super.onCreate(savedInstanceState);
		setContentView(R.layout.page1);
		Bundle extras = getIntent().getExtras();
        if (extras != null)
		{
		    value = extras.getString("user");
		}
		
		prcd = (Button) findViewById(R.id.button1);
		hme = (Button) findViewById(R.id.button2);
		
        
        UserFunctions userFunction = new UserFunctions();
		JSONObject json = userFunction.stations();
		
		try {
			JSONObject json_user = json.getJSONObject("user");
			
			JSONObject json_user1 = json_user.getJSONObject("one");
			JSONObject json_user2 = json_user.getJSONObject("two");
			JSONObject json_user3 = json_user.getJSONObject("three");
			JSONObject json_user4 = json_user.getJSONObject("four");
			JSONObject json_user5 = json_user.getJSONObject("five");
			JSONObject json_user6 = json_user.getJSONObject("six");
			JSONObject json_user7 = json_user.getJSONObject("seven");
			
		     result1[0] = json_user1.getString("station_name");
		     result1[1] = json_user2.getString("station_name");
		     result1[2] = json_user3.getString("station_name");
		     result1[3] = json_user4.getString("station_name");
		     result1[4] = json_user5.getString("station_name");
		     result1[5] = json_user6.getString("station_name");
		     result1[6] = json_user7.getString("station_name");
			
		} catch (JSONException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
      //paring data
      
        
		final Spinner dropdown = (Spinner)findViewById(R.id.spinner1);
		String[] items = new String[]{result1[0],result1[1],result1[2],result1[3],result1[4],result1[5],result1[6]};
		ArrayAdapter<String> adapter = new ArrayAdapter<String>(this, android.R.layout.simple_spinner_item, items);
		dropdown.setAdapter(adapter);
		
		final Spinner dropdown1 = (Spinner)findViewById(R.id.spinner2);
		ArrayAdapter<String> adapter1 = new ArrayAdapter<String>(this, android.R.layout.simple_spinner_item, items);
		dropdown1.setAdapter(adapter1);
		
		
		
		prcd.setOnClickListener(new View.OnClickListener() {
			 
			  public void onClick(View v) {
				 
					
				  src = (String) dropdown.getSelectedItem();
				  dest= (String) dropdown1.getSelectedItem();
				 
				  if(src == dest)
				  {
			    Toast.makeText(Page1.this,
				" Source & Destination Should Not Be Same ",
					Toast.LENGTH_SHORT).show();
					  
				  }
				  else
				  {
					  
					  Intent route = new Intent(getApplicationContext(),Route1.class);
					  
					  UserFunctions userFunction1 = new UserFunctions();
					  @SuppressWarnings("unused")
					  JSONObject json1 = userFunction1.deletall(value);
					  UserFunctions userFunction = new UserFunctions();
					  @SuppressWarnings("unused")
					  JSONObject json = userFunction.route(src,dest,value);
					  route.putExtra("src", src);
					  route.putExtra("dest",dest);
					  route.putExtra("user",value);
					  startActivity(route);
				  }
				
			  }
			  
			});
		
		hme.setOnClickListener(new View.OnClickListener() {
			 public void onClick(View v) {
				 
				 Intent home = new Intent(getApplicationContext(),Page.class);
				 startActivity(home);
			 }
			  
		});
		
	}		
	
		
	
}
