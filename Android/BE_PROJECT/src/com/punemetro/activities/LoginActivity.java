
package com.punemetro.activities;

import org.json.JSONException;
import org.json.JSONObject;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.example.androidhive.R;
import com.punemetro.activities.library.UserFunctions;

public class LoginActivity extends Activity {
	Button btnLogin;
	Button btnLinkToRegister;
	EditText inputmobileno;
	EditText inputPassword;
	TextView loginErrorMsg;

	// JSON Response node names
	private static String KEY_SUCCESS = "success";
	final Context context = this;
	

	@Override
	public void onCreate(Bundle savedInstanceState)
	{
		super.onCreate(savedInstanceState);
		setContentView(R.layout.login);

		// Importing all assets like buttons, text fields
		inputmobileno = (EditText) findViewById(R.id.loginMob);
		inputPassword = (EditText) findViewById(R.id.loginPassword);
		btnLogin = (Button) findViewById(R.id.btnLogin);
		btnLinkToRegister = (Button) findViewById(R.id.btnLinkToRegisterScreen);
		loginErrorMsg = (TextView) findViewById(R.id.login_error);
		loginErrorMsg.setText("");
		
		btnLogin.setEnabled(true);
		// Login button Click Event
		btnLogin.setOnClickListener(new View.OnClickListener() {

			public void onClick(View view) {
				btnLogin.setEnabled(false);
				loginErrorMsg.setText("");
				String mobileno = inputmobileno.getText().toString();
				String password = inputPassword.getText().toString();
				UserFunctions userFunction = new UserFunctions();
				Log.d("Button", "Login");
				JSONObject json = userFunction.loginUser(mobileno, password);

				// check for login response
				try {
					if (inputmobileno.length()>0 &&
						inputPassword.length()>0	) {
								
						if (json.getString(KEY_SUCCESS) != null) {
							loginErrorMsg.setText("");
							String res = json.getString(KEY_SUCCESS); 
							if(Integer.parseInt(res) == 1){
							// 	user successfully logged in
								
								@SuppressWarnings("unused")
								JSONObject json_user = json.getJSONObject("user");
								
							// 	Clear all previous data in database
								
														
								
							// 	Launch Dashboard Screen
								Intent page = new Intent(getApplicationContext(),Page.class);
								page.putExtra("user",mobileno );
							// 	Close all views before launching NEXT PAGE
								page.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
								startActivity(page);
								
							// 	Close Login Screen
								finish();
							}
							else
							{
							// 	Error in login
								btnLogin.setEnabled(true);
								loginErrorMsg.setText("Incorrect username/password");
								Toast.makeText(LoginActivity.this,
										"Incorrect username/password",
											Toast.LENGTH_SHORT).show();
								}
							}
						}
					else
					{
						btnLogin.setEnabled(true);
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
						alertDialog.show();
					
					}
					} catch (JSONException e) {
						e.printStackTrace();
				}
			}
		});

		// Link to Register Screen
		btnLinkToRegister.setOnClickListener(new View.OnClickListener() {

			public void onClick(View view) {
				Intent i = new Intent(getApplicationContext(),
						RegisterActivity.class);
				startActivity(i);
				finish();
			}
		});
	}
}
