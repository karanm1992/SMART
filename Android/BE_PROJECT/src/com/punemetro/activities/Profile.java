package com.punemetro.activities;

import java.util.Calendar;

import org.json.JSONException;
import org.json.JSONObject;

import com.example.androidhive.R;
import com.punemetro.activities.library.UserFunctions;

import android.app.Activity;
import android.app.AlertDialog;
import android.app.DatePickerDialog;
import android.app.Dialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.TextView;

public class Profile extends Activity {
	
	private Button cncl,btn_save;
	
	public String value,fname,email,dob,gen,address,city,state,country;
	public EditText name1,email1,password1,gen1,add1,city1,state1,country1;
	public CheckBox male,female;
	public TextView dob1;
	
	final Context context = this;
	
	private int mYear;
	private int mMonth;
	private int mDay;
	
	private Button mPickDate;
	
	static final int DATE_DIALOG_ID = 0;
	
	public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.profile);
        Bundle extras = getIntent().getExtras();
        if (extras != null)
		{
		    value = extras.getString("user");
		}
        
        cncl = (Button) findViewById(R.id.button3);
        name1 = (EditText)findViewById(R.id.editText1);
        email1 = (EditText)findViewById(R.id.editText2);
        add1 = (EditText)findViewById(R.id.editText3);
        city1 = (EditText)findViewById(R.id.editText4);
        state1 = (EditText)findViewById(R.id.editText5);
        country1 = (EditText)findViewById(R.id.editText6);
        dob1 = (TextView) findViewById(R.id.textView2);
        male = (CheckBox)findViewById(R.id.checkBox1); 
        female = (CheckBox)findViewById(R.id.checkBox2);
        btn_save = (Button) findViewById(R.id.button2);
        mPickDate = (Button) findViewById(R.id.button1);
        
        UserFunctions userFunction = new UserFunctions();
		JSONObject json= userFunction.edit(value);
		
		try {
			
			JSONObject json_user = json.getJSONObject("user");
			fname = json_user.getString("name");
			email = json_user.getString("email");
			city = json_user.getString("city");
			address = json_user.getString("address");
			state = json_user.getString("state");
			country = json_user.getString("country");
			gen = json_user.getString("gender");
			dob = json_user.getString("dob");
			
			
		} catch (JSONException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
        
        
		int n = fname.length();
		int e = email.length();
		int a = address.length();
		int ct = city.length();
		int s = state.length();
		int cn = country.length();
		int db = dob.length();
		
		CharSequence nvalue = null;
		nvalue = fname.subSequence(0,n);
		name1.setText(nvalue);
		
		CharSequence evalue = null;
		evalue = email.subSequence(0,e);
		email1.setText(evalue);
        
		CharSequence avalue = null;
		avalue = address.subSequence(0, a);
		add1.setText(avalue);
		
		CharSequence cvalue = null;
		cvalue = city.subSequence(0,ct);
		city1.setText(cvalue);
		
		CharSequence svalue = null;
		svalue = state.subSequence(0,s);
		state1.setText(svalue);
		
		CharSequence cnvalue = null;
		cnvalue = country.subSequence(0,cn);
		country1.setText(cnvalue);
		
		CharSequence dbvalue = null;
		dbvalue = dob.subSequence(0,db);
		dob1.setText(dbvalue);
		
		
		
		if(gen.equals("male"))
		{
			male.setChecked(true);
			//female.setEnabled(false);
			
		}
		if(gen.equals("female"))
		{
			female.setChecked(true);
			//male.setEnabled(false);
			
		}
		male.setOnClickListener(new View.OnClickListener()
	    {			
			
			public void onClick(View v) 
			{
				
				if(male.isChecked())
			    {
			    	female.setEnabled(false);
			    }
				else
				{
					female.setEnabled(true);
				}
			}
	    });
	    female.setOnClickListener(new View.OnClickListener()
	    {			
			
			public void onClick(View v) 
			{
				
				if(female.isChecked())
			    {
			    	male.setEnabled(false);
			    }
				else
				{
					male.setEnabled(true);
				}
			}
	    });
		 mPickDate.setOnClickListener(new View.OnClickListener() {
		        @SuppressWarnings("deprecation")
				public void onClick(View v) {
		            showDialog(DATE_DIALOG_ID);
		        }
		    });
		 
		 final Calendar c = Calendar.getInstance();
		    mYear = c.get(Calendar.YEAR);
		    mMonth = c.get(Calendar.MONTH);
		    mDay = c.get(Calendar.DAY_OF_MONTH);
		    
		    updateDisplay();
		    btn_save.setOnClickListener(new View.OnClickListener() 
		    {   
		    	public void onClick(View v) 
		    	{	
		    		
		    		if	(name1.length() > 0 &&		
							email1.length() > 0 &&
							add1.length() > 0 &&
							city1.length()> 0 &&
							country1.length() > 0 &&
							state1.length() > 0 
							)
						
						
						{
								if(android.util.Patterns.EMAIL_ADDRESS.matcher(email1.getText().toString()).matches())
								{
									
									if(male.isChecked())
									{
										gen="male";
									}
									if(female.isChecked())
									{
										gen="female";
									}
										String ename = name1.getText().toString();
										String eemail = email1.getText().toString();
										String eadd = add1.getText().toString();
										String ecity = city1.getText().toString();
										String estate = state1.getText().toString();
										String ecountry = country1.getText().toString();
										String edob = dob1.getText().toString();
					
										UserFunctions userFunction = new UserFunctions();
										@SuppressWarnings("unused")
										JSONObject json = userFunction.update(ename, eemail, value, gen, eadd, edob, ecity, estate, ecountry);
					
										AlertDialog.Builder alertDialogBuilder = new AlertDialog.Builder(
												context);
										alertDialogBuilder.setTitle("Success!!");
										alertDialogBuilder.setCancelable(true);
										alertDialogBuilder
										.setMessage("Changes Saved Successfully")
										.setNeutralButton("OK", new DialogInterface.OnClickListener() {
											public void onClick(DialogInterface dialog, int id)
											{
												Intent dashboard = new Intent(getApplicationContext(), Page.class);
												dashboard.putExtra("user", value);
												startActivity(dashboard);
											}
										});
					
						//create alert dialog
										AlertDialog alertDialog = alertDialogBuilder.create();
					
				// 	show it
										alertDialog.show();
								}
								else
								{
									AlertDialog.Builder alertDialogBuilder = new AlertDialog.Builder(
											context);
									alertDialogBuilder.setTitle("Error!");
									alertDialogBuilder.setCancelable(true);
									alertDialogBuilder
									.setMessage("Invalid E-mail")
									.setNeutralButton("OK", new DialogInterface.OnClickListener() {
										public void onClick(DialogInterface dialog, int id)
										{
											dialog.cancel();
										}
									});
						
									// 	create alert dialog
									AlertDialog alertDialog = alertDialogBuilder.create();
						
									// 	show it
									alertDialog.show();
								}
							
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
				
		    				// 	create alert dialog
		    				AlertDialog alertDialog = alertDialogBuilder.create();
				
		    				// 	show it
		    				alertDialog.show();
		    			} 
				 }  
			}); 
										
	cncl.setOnClickListener(new View.OnClickListener() {
			 public void onClick(View v) {
				 Intent home = new Intent(getApplicationContext(),Page.class);
				 home.putExtra("user", value);
				 startActivity(home);
			 }  
		}); 
	}
	private void updateDisplay() {
	    this.dob1.setText(
	        new StringBuilder()
	                // Month is 0 based so add 1
	                .append(mMonth + 1).append("-")
	                .append(mDay).append("-")
	                .append(mYear).append(" "));
	}
	private DatePickerDialog.OnDateSetListener mDateSetListener =
		    new DatePickerDialog.OnDateSetListener() {
		        public void onDateSet(DatePicker view, int year, 
		                              int monthOfYear, int dayOfMonth) {
		            mYear = year;
		            mMonth = monthOfYear;
		            mDay = dayOfMonth;
		            updateDisplay();
		        }
		    };
		    @Override
		    protected Dialog onCreateDialog(int id) {
		       switch (id) {
		       case DATE_DIALOG_ID:
		          return new DatePickerDialog(this,
		                    mDateSetListener,
		                    mYear, mMonth, mDay);
		       }
		       return null;
		    }
}
