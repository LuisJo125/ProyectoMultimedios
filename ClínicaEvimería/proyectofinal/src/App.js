import logo from './logo.svg';
import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import Menu from './misc/menu';
import Footer from './misc/footer';
import Citas from './citas/Citas';

function App() {
  return (
    <div className="container-fluid">
      <div className="menu-container">
        <Menu />
      </div>
      <div className="body-container">
        <div className='container text-center'>
          <h1>Clínica Evimería</h1>
        </div>
        <div className='container-fluid'>
          <div className='container-fluid row col-12'>
            <div className='container-fluid col-6 text-center body-elements'>
              <p>info izquierda</p>
            </div>
            <div className='container-fluid col-6 text-center body-elements'>
              <p>info derecha</p>
            </div>
          </div>
          <div className='container-fluid row'>
            <div className='container-fluid text-center body-elements'>
              <p>un carousel imagenes</p>
            </div>
          </div>
          <div className='container-fluid row'>
            <Citas/>
          </div>
        </div>
      </div>
      <div className="footer-container">
        <Footer/>
      </div>
    </div>
  );
}

export default App;
