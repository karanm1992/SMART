package com.punemetro.activities;

import java.util.Arrays;
import org.json.JSONException;
import org.json.JSONObject;

import com.example.androidhive.R;
import com.punemetro.activities.library.UserFunctions;

import android.annotation.SuppressLint;
import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.Spinner;
import android.widget.TextView;

public class Route1 extends Activity
{
	String value,value1 = null;
	public String mno;
	public int ct=0;
	TextView src,dest;
	private Button hme,prcd;
	public String utime;
	
	String [] result1 = new String[100];
	String [] result2 = new String[100];
	
	@SuppressLint("NewApi")
	public void onCreate(Bundle savedInstanceState) 
	{
		super.onCreate(savedInstanceState);
		setContentView(R.layout.route1);
		Bundle extras = getIntent().getExtras();
		
		hme = (Button) findViewById(R.id.button2);
		prcd = (Button) findViewById(R.id.button1);
		
		if (extras != null)
		{
		    value = extras.getString("src");
		    value1= extras.getString("dest");
		    mno = extras.getString("user");
		}
		int n = value.length();
		int n1 = value1.length();
		src = (TextView)findViewById(R.id.textView1);
		
		CharSequence svalue = null;
		svalue = value.subSequence(0,n);
		src.setText(svalue);
		
		dest = (TextView)findViewById(R.id.textView3);
		
		CharSequence dvalue = null;
		dvalue = value1.subSequence(0,n1);
		dest.setText(dvalue);
		
		UserFunctions userFunction = new UserFunctions();
		JSONObject json = userFunction.showtime(mno);
		String fd_nam = null;

		
		try {
			
			JSONObject c = json.getJSONObject("time");
			for(int i = 0; i < 20; i++)
			{
				fd_nam =c.getString("t"+i);
                result1[i] = fd_nam;
                result2[i] = result1[i];
			}
		
		} catch (JSONException e) 
		{
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
		
		
		final Spinner dd = (Spinner)findViewById(R.id.spinner1);
		String [] items = Arrays.copyOfRange(result2, 0,20);
		ArrayAdapter<String> adapter = new ArrayAdapter<String>(this, android.R.layout.simple_expandable_list_item_1, items);
		adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
		dd.setAdapter(adapter);
		
		prcd.setOnClickListener(new View.OnClickListener() {
			 public void onClick(View v)
			 {
				 utime = (String) dd.getSelectedItem();
					
				 Intent pg = new Intent(getApplicationContext(),Info.class);
				 pg.putExtra("user", mno);
				 pg.putExtra("src",value);
				 pg.putExtra("dest", value1);
				 pg.putExtra("time", utime);
				 startActivity(pg);
		
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
