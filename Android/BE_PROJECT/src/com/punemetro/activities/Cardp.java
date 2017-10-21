package com.punemetro.activities;

import org.json.JSONObject;

import com.example.androidhive.R;
import com.punemetro.activities.library.UserFunctions;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

public class Cardp extends Activity 
{
	EditText name,num,cvv;
	Button prcd;
	static final int DATE_DIALOG_ID = 0;
	final Context context = this;
	public String mno,count,cnt;
	public void onCreate(Bundle savedInstanceState) 
	{
        super.onCreate(savedInstanceState);
        setContentView(R.layout.card);
        Bundle extras = getIntent().getExtras();
		if (extras != null)
		{
		    mno = extras.getString("user");
		    count = extras.getString("count");
		}
        
        prcd = (Button)findViewById(R.id.button1);
        name = (EditText)findViewById(R.id.editText1);
        num = (EditText)findViewById(R.id.editText2);
        cvv = (EditText)findViewById(R.id.editText3);
        
      
        
        prcd.setOnClickListener(new View.OnClickListener() {
			 public void onClick(View v)
			 {
				 
				 if(name.length() > 0 &&
						 num.length() > 0 &&
						 cvv.length() > 0)
				 {
				 
					 UserFunctions userFunction1 = new UserFunctions();
						@SuppressWarnings("unused")
						JSONObject json1 = userFunction1.makepayment(mno);
				 
				 Intent pg = new Intent(getApplicationContext(),Sel_ticket.class);
				 pg.putExtra("no", count);
				 pg.putExtra("user", mno);
				 startActivity(pg);
				 
				 }
				 else
				 {
					 AlertDialog.Builder alertDialogBuilder = new AlertDialog.Builder(
								context);
						alertDialogBuilder.setTitle("Error!");
						alertDialogBuilder.setCancelable(true);
						alertDialogBuilder
							.setMessage("Please fill all fields")
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
			 } 
		});   
	}
}
