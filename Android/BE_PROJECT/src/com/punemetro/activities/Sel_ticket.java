package com.punemetro.activities;

import java.util.Arrays;

import org.json.JSONException;
import org.json.JSONObject;

import com.example.androidhive.R;
import com.punemetro.activities.library.UserFunctions;

import android.annotation.SuppressLint;
import android.app.Activity;
import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.Spinner;

public class Sel_ticket extends Activity 
{
	String [] result1 = new String[100];
	public String mno,count,cnt,ch,sr,de,tm;
	private Button tick,home,delt;
	final Context context = this;
	@SuppressLint("NewApi")
	public void onCreate(Bundle savedInstanceState) 
	{
        super.onCreate(savedInstanceState);
        setContentView(R.layout.sel_ticket);
        
        Bundle extras = getIntent().getExtras();
		if (extras != null)
		{
		    mno = extras.getString("user");
		    count = extras.getString("no");
		}
		
		int c = Integer.parseInt(count);
		
		for(int i = 0 ; i < c ; i++)
		{
			result1[i] = "Ticket " + (i+1);
		}
		
		final Spinner dd = (Spinner)findViewById(R.id.spinner1);
		String [] items = Arrays.copyOfRange(result1, 0, c);
		
		ArrayAdapter<String> adapter = new ArrayAdapter<String>(this, android.R.layout.simple_expandable_list_item_1, items);
		adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
		dd.setAdapter(adapter);
		
		tick = (Button) findViewById(R.id.button1);
		
		tick.setOnClickListener(new View.OnClickListener() {
			 public void onClick(View v)
			 {
				 ch = (String) dd.getSelectedItem();
				 String t_no;
				 if(ch.equals("Ticket 1"))
				 {
					 	t_no = "1";
					 	UserFunctions userFunction = new UserFunctions();
						@SuppressWarnings("unused")
						JSONObject json = userFunction.imggen(mno,t_no); 
						
					
						UserFunctions userFunction1 = new UserFunctions();
						JSONObject json1 = userFunction1.mydetails(mno,t_no);
						
						try 
						{
							JSONObject json_user1 = json1.getJSONObject("user");
							sr = json_user1.getString("src");
							de = json_user1.getString("dest");
							tm = json_user1.getString("time");
							
						} catch (JSONException e) {
							// TODO Auto-generated catch block
							e.printStackTrace();
						}
				 }
				 else if(ch.equals("Ticket 2"))
				 {
					 	t_no = "2";
					 	UserFunctions userFunction = new UserFunctions();
						@SuppressWarnings("unused")
						JSONObject json = userFunction.imggen(mno,t_no);
						
						UserFunctions userFunction1 = new UserFunctions();
						JSONObject json1 = userFunction1.mydetails(mno,t_no);
						
						try 
						{
							JSONObject json_user1 = json1.getJSONObject("user");
							sr = json_user1.getString("src");
							de = json_user1.getString("dest");
							tm = json_user1.getString("time");
							
						} catch (JSONException e) {
							// TODO Auto-generated catch block
							e.printStackTrace();
						}
				 }
				 else
				 {
					 	t_no = "3";
					 	UserFunctions userFunction = new UserFunctions();
						@SuppressWarnings("unused")
						JSONObject json = userFunction.imggen(mno,t_no);
						UserFunctions userFunction1 = new UserFunctions();
						JSONObject json1 = userFunction1.mydetails(mno,t_no);
						
						try 
						{
							JSONObject json_user1 = json1.getJSONObject("user");
							sr = json_user1.getString("src");
							de = json_user1.getString("dest");
							tm = json_user1.getString("time");
							
						} catch (JSONException e) {
							// TODO Auto-generated catch block
							e.printStackTrace();
						}
				 }
				 
				 if(sr.equals("expired"))
				 {
					 AlertDialog.Builder alertDialogBuilder = new AlertDialog.Builder(
								context);
						alertDialogBuilder.setTitle("Details");
						alertDialogBuilder.setCancelable(true);
						alertDialogBuilder
							.setMessage("TICKET EXPIRED")
							.setNeutralButton("OK", new DialogInterface.OnClickListener() {
			                	public void onClick(DialogInterface dialog, int id)
			                	{
			                		dialog.cancel();
			                	}
							});
						AlertDialog alertDialog = alertDialogBuilder.create();
						
						// 	show it
							alertDialog.show();
				 }
				 else
				 {
				 AlertDialog.Builder alertDialogBuilder = new AlertDialog.Builder(
							context);
					alertDialogBuilder.setTitle("Details");
					alertDialogBuilder.setCancelable(true);
					alertDialogBuilder
						.setMessage(sr +" -> "+ de+"      Departure : "+tm)
						.setNeutralButton("OK", new DialogInterface.OnClickListener() {
		                	public void onClick(DialogInterface dialog, int id)
		                	{
		                		Intent pg = new Intent(getApplicationContext(),Qrcode.class);
		       				 	pg.putExtra("user",mno);
		       				 	pg.putExtra("no",count);
		       				 	startActivity(pg);
		                	}
						});
					AlertDialog alertDialog = alertDialogBuilder.create();
					
					// 	show it
						alertDialog.show();
				 
		
			 }
			 } 
		});
		
		home = (Button) findViewById(R.id.button2);
		home.setOnClickListener(new View.OnClickListener() {
			 public void onClick(View v)
			 {
				 Intent hme = new Intent(getApplicationContext(),Page.class);
				 hme.putExtra("user",mno);
				 //hme.putExtra("no",count);
				 startActivity(hme); 
			 }
			  
		});
		
		delt = (Button) findViewById(R.id.button3);
		delt.setOnClickListener(new View.OnClickListener() {
			 public void onClick(View v)
			 {
				 
				AlertDialog.Builder alertDialogBuilder = new AlertDialog.Builder(
						context);
				alertDialogBuilder.setTitle("Confirm");
				alertDialogBuilder.setCancelable(true);
				alertDialogBuilder
					.setMessage("Do you really want to Delete Tickets ???")
					.setPositiveButton("OK", new DialogInterface.OnClickListener() {
				        public void onClick(DialogInterface dialog, int which) {
	                		UserFunctions userFunction = new UserFunctions();
	        				@SuppressWarnings("unused")
	        				JSONObject json = userFunction.deletall(mno);
	                		Intent hme = new Intent(getApplicationContext(),Page.class);
	       				 	hme.putExtra("user",mno);
	       				 //hme.putExtra("no",count);
	       				 	startActivity(hme);
	                	}
					});
				alertDialogBuilder.setNegativeButton("Cancel", new DialogInterface.OnClickListener() {
			        public void onClick(DialogInterface dialog, int which) {

			            dialog.cancel();
			      } });
			// 	create alert dialog
				AlertDialog alertDialog = alertDialogBuilder.create();
				
			// 	show it
				alertDialog.show();
				
				  
			 }
			  
		});
		
	}
	
}
