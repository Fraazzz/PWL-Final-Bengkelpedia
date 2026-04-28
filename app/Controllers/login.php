function auth()
{
    $email = $this->request->getPost('email');
     $password = $this->request->getPost('paswd');

}

function logout()
{
    session();
    session()->destroy();
    return redirect()->to('/')
}