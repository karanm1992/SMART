
package com.punemetro.activities;

import java.util.Calendar;

import org.json.JSONException;
import org.json.JSONObject;

import com.example.androidhive.R;
import com.punemetro.activities.library.UserFunctions;

import android.app.Activity;
import android.app.DatePickerDialog;
import android.app.Dialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.app.AlertDialog;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.TextView;

public class RegisterActivity extends Activity {
	Button btnRegister;
	Button btnLinkToLogin;
	EditText inputFullName;
	EditText inputEmail;
	EditText inputPassword;
	EditText inputmobileno;
	EditText inputaddress;
	EditText inputcity;
	EditText inputstate;
	EditText inputcountry;
	TextView registerErrorMsg;
	TextView inputdate;
	
	public  CheckBox male,female;
	public String gen;
	
	private int mYear;
	private int mMonth;
	private int mDay;

	private TextView mDateDisplay;
	private Button mPickDate;

	static final int DATE_DIALOG_ID = 0;
	private static String KEY_SUCCESS = "success";
	final Context context = this;
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.register);

		// Importing all assets like buttons, text fields
		inputFullName = (EditText) findViewById(R.id.registerName);
		inputEmail = (EditText) findViewById(R.id.registerEmail);
		inputPassword = (EditText) findViewById(R.id.registerPassword);
		inputmobileno=(EditText) findViewById(R.id.editText1);
		inputaddress=(EditText) findViewById(R.id.editText2);
		inputcity=(EditText) findViewById(R.id.editText3);
		inputstate=(EditText) findViewById(R.id.editText4);
		inputcountry=(EditText) findViewById(R.id.editText5);
		btnRegister = (Button) findViewById(R.id.btnRegister);
		btnLinkToLogin = (Button) findViewById(R.id.btnLinkToLoginScreen);
		registerErrorMsg = (TextView) findViewById(R.id.register_error);
		male=(CheckBox)findViewById(R.id.checkBox1);
		female=(CheckBox)findViewById(R.id.checkBox2);
		mDateDisplay = (TextView) findViewById(R.id.textView3);        
	    mPickDate = (Button) findViewById(R.id.button1);
	    inputdate = (TextView) findViewById (R.id.textView3);
		
	    mPickDate.setOnClickListener(new View.OnClickListener() {
	        @SuppressWarnings("deprecation")
			public void onClick(View v) {
	            showDialog(DATE_DIALOG_ID);
	        }
	    });

	    // get the current date
	    final Calendar c = Calendar.getInstance();
	    mYear = c.get(Calendar.YEAR);
	    mMonth = c.get(Calendar.MONTH);
	    mDay = c.get(Calendar.DAY_OF_MONTH);

	    // display the current date
	    updateDisplay();
	    
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
		// Register Button Click event
		btnRegister.setOnClickListener(new View.OnClickListener() 
		{			
			
			public void onClick(View view) 
			{
				registerErrorMsg.setText("");
				if	(inputFullName.length() > 0 &&		
					inputPassword.length() > 0 && 
					inputEmail.length() > 0 &&
					inputmobileno.length() > 0 &&
					inputaddress.length() > 0 &&
					inputcity.length()> 0 &&
					inputstate.length() > 0 &&
					inputcountry.length() > 0 
					)
				
				
				{
					if(inputmobileno.length() == 10 )
					{
					if(inputPassword.length() > 7 && inputPassword.getText().toString().matches("^(?=.*\\d)(?=.*[A-Z])(?=.*[a-z])[^\\W_]{4,10}$"))
					{
						
						
						if(android.util.Patterns.EMAIL_ADDRESS.matcher(inputEmail.getText().toString()).matches())
						{
							
						if(male.isChecked())
						{
							gen="male";
						}
						if(female.isChecked())
						{
							gen="female";
						}
						String name = inputFullName.getText().toString();
						String email = inputEmail.getText().toString();
						String password = inputPassword.getText().toString();
						String mobile = inputmobileno.getText().toString();
						String addr = inputaddress.getText().toString();
						String city = inputcity.getText().toString();
						String state = inputstate.getText().toString();
						String country = inputcountry.getText().toString();
						String birthd = inputdate.getText().toString();
						UserFunctions userFunction = new UserFunctions();
						JSONObject json = userFunction.registerUser(name, email, password,mobile,gen,addr,birthd,city,state,country);
						
						// check for login response
						try 
						{
							if (json.getString(KEY_SUCCESS) != null)
							{
								registerErrorMsg.setText("");
								String res = json.getString(KEY_SUCCESS); 
								if(Integer.parseInt(res) == 1)
								{
									
									
									AlertDialog.Builder alertDialogBuilder = new AlertDialog.Builder(
											context);
									alertDialogBuilder.setTitle("Success!!");
									alertDialogBuilder.setCancelable(true);
									alertDialogBuilder
										.setMessage("Registration Successful")
										.setNeutralButton("OK", new DialogInterface.OnClickListener() {
						                	public void onClick(DialogInterface dialog, int id)
						                	{
						                		Intent dashboard = new Intent(getApplicationContext(), DashboardActivity.class);
												startActivity(dashboard);
						                	}
										});
									
//								 	create alert dialog
									AlertDialog alertDialog = alertDialogBuilder.create();
									
								// 	show it
									alertDialog.show();
								// 	user successfully registered
								
								}
								
								else
								{
								// 	Error in registration
									registerErrorMsg.setText("Username Already Exisist...!");
								}
							}
						}
						
						catch (JSONException e) 
						{
							e.printStackTrace();
						}
						}//if end
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
					}//if end
					else
					{
						AlertDialog.Builder alertDialogBuilder = new AlertDialog.Builder(
								context);
						alertDialogBuilder.setTitle("Error!");
						alertDialogBuilder.setCancelable(true);
						alertDialogBuilder
							.setMessage("Password - 1.Length Between 8-14" +
									"2.Must Contain a Capital Letter"+
									"3.Must Contain a Number "+
									"4.No Special Characters")
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
					else{
						
						AlertDialog.Builder alertDialogBuilder = new AlertDialog.Builder(
								context);
						alertDialogBuilder.setTitle("Error!");
						alertDialogBuilder.setCancelable(true);
						alertDialogBuilder
							.setMessage("Mobile Number should be of 10 Digits" +
									" & Starting Should not be with 0")
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
				}//onclick procedure
			});//Onclick listener brace
		
			
		// Link to Login Screen
		btnLinkToLogin.setOnClickListener(new View.OnClickListener() {

			public void onClick(View view) {
				Intent i = new Intent(getApplicationContext(),
						LoginActivity.class);
				startActivity(i);
				// Close Registration View
				finish();
			}
		});
		
	}
	private void updateDisplay() {
	    this.mDateDisplay.setText(
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



