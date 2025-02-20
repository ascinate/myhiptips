<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminEmployeeController extends Controller
{
    public function employee()
    {
        $id = Session::get('emp_id');
        
        $tips = DB::table('tips_master')
        ->whereRaw("find_in_set(?, employee)", [$id])
        ->get();

        return view('employee.login', compact('tips'));
       
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        $employee = DB::table('employee_master')
            ->where('email', $request->email)
            ->where('password', $request->password)
            ->first();
    
        if ($employee) {
            $request->session()->put('employeeuser', $employee->email);
            $request->session()->put('emp_first', $employee->first_name);
            $request->session()->put('emp_last', $employee->last_name);
            $request->session()->put('emp_id', $employee->id);
            $request->session()->put('photo', $employee->photo);
            
            return redirect('/employee/dashboard');
        } else {
            return redirect('/employee/login')->with('msg', 'Invalid email or password.');
        }
    }

    public function dashboard(Request $request)
    {

        $data['tips'] = $this->tips($request);
        return view('employee.dashboard', $data);
        
    }

    public function empforgotpass(Request $request)
    {
        $email = $request->input('email');

        // Querying using Laravel's Query Builder
        $user = DB::table('employee_master')->where('email', $email)->first();

        if ($user) {
            $to = $email;
            $subject = "Forgot Password - myhiptips.com";

            // Create the email message content (HTML format)
            $htmlMessage = '
            <html>
            <body>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>
                      <table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
                       <tr>
                        <td>
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
                            <tr>
                              <td>
                                  <tr>
                                    <td>
                                      <figure style="width: 100%; margin: auto; text-align: center;">
                                        <img style="width:25%; margin: auto;" src="' . asset('style/images/logo-mailer.jpg') . '" alt="logo"/>
                                      </figure>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td>
                                      <table border="0" cellpadding="0" cellspacing="0" class="image_block block-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                        <tbody><tr>
                                          <td class="pad" style="padding-left:10px;padding-right:10px;">
                                          <div style="font-family: AvantGarde Md BT;">
                                          <div class="" style="font-size: 12px; font-family: AvantGarde Md BT;  mso-line-height-alt: 14.3px; color: #262626; line-height: 1.2;">
                                          <p style="margin: 0; font-size: 30px; font-weight: 800 !important; text-align: center; mso-line-height-alt: 16.8px;">
                                            <span style="display: block;">Welcome to Hiptips</span>
                                          </p>

                                          </div>
                                          </div>
                                          </td>
                                          </tr>
                                      </tbody>
                                      </table>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td>
                                      <h5 style="text-align: center; font-family:Arial, Helvetica, sans-serif;  font-weight: 500; font-size: 22px; margin-bottom: 10px;">
                                          Thank you for contacting us. You will find your login credentials as below.
                                      </h5>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td>
                                        <p style="text-align: center;">
                                          <span style="font-weight: 500; font-size: 20px;">Email:</span> 
                                          <span style="font-weight: 400; font-size: 18px; padding-left:10px;">' . $email . '</span> 
                                        </p>
                                        <p style="text-align: center;">
                                          <span style="font-weight: 500; font-size: 20px;">Password:</span> 
                                          <span style="font-weight: 400; font-size: 18px; padding-left:10px;">' . $user->password . '</span> 
                                        </p>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td>
                                      <span style="display: block; float: left; margin-top:20px; line-height: 25px; font-family:Arial, Helvetica, sans-serif; font-weight: 600; font-size: 16px; color: #b27bff ;">	Regards,
                                        <b style="display: block;"> MyHiptips team </b> </span>
                                    </td>
                                  </tr>

                            </td>
                            </tr>
                          </table>
                        </td>

                       </tr>
                      </table>
                    </td>
                  </tr>
                </table>
            </body>
            </html>';

            // Sending email using Laravel's Mail facade without Mailgun
            Mail::send([], [], function ($mailMessage) use ($to, $subject, $htmlMessage) {
                $mailMessage->to($to)
                            ->subject($subject)
                            ->setBody($htmlMessage, 'text/html');
                $mailMessage->from('support@myhiptips.com'); // Update with your email address
            });

            return response()->json(['message' => 'Password sent successfully to your email.'], 200);
        } else {
            return response()->json(['message' => 'Wrong email address.'], 404);
        }
    }

        public function tips(Request $request)
        {
            $corId = Session::get('hotel_id');
            $to = $request->input('date_to');
            $from = $request->input('date_from');
            $employee = Session::get('emp_id');
            $department = Session::get('department');

            $query = DB::table('tips_master');

            if (!empty($to) && !empty($from)) {
                $query->whereBetween('date_of_tip', [$to, $from]);
            }

            if (!empty($department)) {
                $query->where('department', $department);
            }

            if (!empty($employee)) {
                $query->where('employee', 'like', "%$employee%");
            }

            if (!empty($corId)) {
                $query->where('hotel', $corId);
            }

            return $query->get();
        }
        

        public function employeeedit()
        {
            $empId = Session::get('emp_id');
            $employee = DB::table('employee_master')->where('id', $empId)->first();
          
            return view('employee.editprofile', compact('employee'));
    
    
    
        }

        public function updateProfile(Request $request)
        {
            $id = Session::get('emp_id');
        $employee = DB::table('employee_master')->where('id', $id)->first();
    
        if (!$employee) {
            return redirect()->back()->with('error', 'Profile not found!');
        }
    
        
        DB::table('employee_master')
            ->where('id', $id)
            ->update([
                'first_name'    => $request->input('first_name'),
                'last_name'         => $request->input('last_name'),
                'email'      => $request->input('email'),
                'password'  => $request->input('password'),
                'phone'         => $request->input('phone'),
            
            ]);
    
      
        return redirect('/employee/edit')->with('msg', 'Profile updated successfully!');
        }

    public function employeelogin(){
        Auth::logout();
        return redirect('/employee/login');
    }

}
