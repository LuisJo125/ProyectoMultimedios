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
          <h1 className='main-title-style'>Clínica Evimería</h1>
        </div>
        <div className='container-fluid'>
          <div className='container-fluid row col-12'>
            <div className='container-fluid col-6 text-center body-elements'>
              <div className='container-fluid img-container'>
                <img src='https://img.freepik.com/foto-gratis/recepcion-clinica-sala-espera-vestibulo-instalaciones-mostrador-registro-utilizado-pacientes-citas-medicas-mostrador-recepcion-vacio-centro-salud-visitas-control_482257-51247.jpg?t=st=1720098230~exp=1720101830~hmac=15ba4f8aeb825184ffa1cdb9f04390000693dc6e74463119ec57096604838b19&w=996'></img>
              </div>
            </div>
            <div className='container-fluid col-6 text-center body-elements'>
              <h3 className='title-style'>Bienvenidos a Clínica Evimería</h3><br></br>
                <p className='p-style'>Acá podrá encontrar su verdadero bienestar, contamos con diferentes servicios que se adaptan a tus necesidades.</p>
                <h4>Ven a conocernos!</h4>
            </div>
          </div>
          <div className='container-fluid row'>
            <div className='container-fluid text-center body-elements'>
              <h3 className='title-style'>Servicio de citas</h3>
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
