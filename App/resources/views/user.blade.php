<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
    
    <script src="https://unpkg.com/react@17/umd/react.development.js" crossorigin></script>
    <script src="https://unpkg.com/react-dom@17/umd/react-dom.development.js" crossorigin></script>
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
    <script src="https://cdnjs.cloudflare.com/ajax/libs/redux/4.0.5/redux.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/redux-thunk/2.3.0/redux-thunk.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react-redux/7.2.2/react-redux.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react-router-dom/5.2.0/react-router-dom.min.js"></script>
    

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <title>Thi trắc nghiệm</title>
    <style>
        #form{
    border-style: groove ;
    padding: 20px;
    width: 250px;
    position:absolute;
    top: 40%;
    left: 40%;  
}
#login{
    float: right;
    margin-right: 12%;
    
}
 #danhsachmonhoc div:hover{
   background: lightblue;
   cursor: pointer; 
}
#danhsach:hover{
    background: lightblue;
    cursor: pointer;
}
.noidung{
    display: none;
    text-align: center;
    /* background: #c2d6d6; */
}
.noidung, #diem{
    margin-top: 24px;
    /* padding-top:30px; */
    /* background: #e6fff7; */
}
.thongtin{
    position: fixed;
    right: 1%;
    top: 2%;
    /* color: red; */
}

body h3{
    color: blue;
}
#diem{
    text-align: center;
}
.viengiua{
    border: 1px solid blue;
    height: 100%;
    position: fixed;
    left: 25%
}
table th{
    text-align: center;
}
table, th, td {
    border: 1px solid black;
  }
table {
    margin-top:30px;
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
  } 
  td, th {
    /* border: 1px solid black; */
    text-align: left;
    padding: 8px;
  }  
  tr:nth-child(even) {
    background-color: #f2f2f2;
  }
  tr:hover {background-color: #ddd;}
  th{
      background: #00cc00;
      color: white;
  }
  

        *{
            padding: 0px;
            margin: 0px;
        }
        .thongtin{
            text-align: right;
        }
        #diem {
            text-align: center;
            margin-top: 80px;
            margin-left: 280px;

        }
        #history {
            margin-top: 40px;
            margin-left: 50px;

        }
        .noidung_info{
            margin-top: 50px;
           
            text-align: center;
            width: 750px;
        }
        .content_left {
            width: 100%;
            height: 100%;
            padding: 10px 0px;
            position: relative;
        }
        .content_left::after {
            content: '';
            height: 100%;
            width: 1px;
            background-color: #0404ff;
            position: absolute;
            top: 0;
            right: 0;
            min-height: 100vh;
        }
        ul li{
            list-style-type: none;
            padding-left: 10px;
            cursor: pointer;
            animation: animate_over 0.5s ease-in-out forwards;
        }
        ul li:hover {
            color: #0404ff;
            animation: animate_hover 0.5s ease-in-out forwards;
        }
        .title{
            color: #0404ff;
        }
        table th{
    text-align: center;
}
table, th, td {
    border: 1px solid black;
  }
table {
    margin-top:30px;
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 400px;
  } 
  td, th {
    /* border: 1px solid black; */
    text-align: left;
    padding: 8px;
  }  
  tr:nth-child(even) {
    background-color: #f2f2f2;
  }
  tr:hover {background-color: #ddd;}
  th{
      background: #00cc00;
      color: white;
  }
</style>
        
   
</head>

<body>
    <div id="app"></div>
 
    <script type="text/babel">

        const { Component } = React;
        const { createStore } = Redux;
        const { Provider, connect } = ReactRedux;
 
        const initState = {
            user: '',
            thi : false,
            tenmh:'',
            danhsachmonhoc : [],
            danhsachdiem: [],
            hienmonhoc: {},
            show : false,
            boolTrangthaimonthi: false,
            show1 : false,
            diemtungmon: '',
            timer : [],
            idmon : 0,
            show2 : false,
            danhsachcauhoi: []
        };
        var dkthi=false;
        var tenmon='';
        const reducer = (state = initState, action) => {
            switch (action.type) {
                case 'GET_USER': {
                    
                    return {...state,user: action.user}
                }
                case 'GET_TENMH': {
                    
                    return {...state,tenmh: action.tenmh}
                }
                case 'GET_IDMH': {
                    
                    return {...state,idmon: action.idmon}
                }

                case 'GET_DANHSACHDIEM': {
                   
                    return {...state,danhsachdiem: action.danhsachdiem}
                }
                case 'GET_DANHSACHCAUHOI': {
                   
                   return {...state,danhsachcauhoi: action.danhsachcauhoi}
               }
                case 'GET_TRANGTHAIMONTHI': {
                 
                    return {...state,boolTrangthaimonthi: action.boolTrangthaimonthi}
                }
                case 'GET_Show': {
                  
                    return {...state, show: action.show}
                }
               
                case 'GET_Show1': {
                    
                    return {...state, show1: action.show1}
                }
                case 'GET_Show2': {
                    
                    return {...state, show2: action.show2}
                }

                case 'GET_DIEMTUNGMON': {
                 
                    return {...state, diemtungmon: action.diemtungmon}
                }
                case 'GET_TIME': {
                 
                 return {...state, timer: action.timer}
             }
             case 'GET_THI': {
                 
                 return {...state, thi: action.thi}
             }
             
                default: return state;

            }
        }

        const store = createStore(reducer);

        class App extends Component {
            render() {
                return (
                    <div className="container-fluid">
                        <div className="row">
                            <DanhsachmonhocConnected />
                            <NoidungConnected />
                            <ThongTinConnected />
                        </div> 
                    </div>
                )
            }
        };
 
        class Danhsachmonhoc extends Component {
            constructor(props){
                super(props);
                this.state = {
                    data : [],
                }
                this.handleCheckPoint = this.handleCheckPoint.bind(this)
            }
            
            componentDidMount(){
                console.log('componentDidMount');
                axios({
                    method: 'get',
                    url: '{{ route('danhsach.check') }}',
                })
                .then( res=>{
                    this.setState({
                        data: res.data
                    })
                    console.log(res.data)
                })
            }

            handleCheckPoint(TenMH,ID){  
                store.dispatch({
                       type: 'GET_TENMH',
                       tenmh:TenMH
                   })
             
                axios({
                    method: 'post',
                    url: '{{ route('clickmonthi.check') }}',
                    data: {
                             TenMH
                            },
                 })
                .then( res=>{
                    console.log(res.data)  
                })


                axios({
                    method: 'post',
                    url: '{{ route('xemdiem.check') }}',
                    data: {
                             TenMH
                            },
                 })
                .then( res=>{
                    console.log(res) 
                
                    if(res.data != -1){
                        store.dispatch({
                       type: 'GET_TRANGTHAIMONTHI',
                       boolTrangthaimonthi: false,  
                   }) 
                   
                   store.dispatch({
                       type: 'GET_Show',
                       show:false
                   })
                   store.dispatch({
                       type: 'GET_Show1',
                       show1:true
                   })
                   let  diemtungmon = res.data
                   store.dispatch({
                       type: 'GET_DIEMTUNGMON',
                       diemtungmon
                      
                   })
                   store.dispatch({
                       type: 'GET_Show2',
                       show2:false
                   })

                    }if(res.data == -1){
                        store.dispatch({
                       type: 'GET_TRANGTHAIMONTHI',
                       boolTrangthaimonthi: true,  
                   }) 
                   store.dispatch({
                       type: 'GET_Show',
                       show:false
                   })
                   store.dispatch({
                       type: 'GET_Show1',
                       show1:false
                   })
                   store.dispatch({
                       type: 'GET_Show2',
                       show2:false
                   })
                   axios({
                    method: 'post',
                    url: '{{ route('laythoigian.check') }}',
                    data: {
                             TenMH
                            },
                 })
               
                    .then( res=>{ 
                        dkthi = res.data.thi
                        tenmon = res.data.tenmon
                        console.log(res.data.thi)
                        console.log(res.data.tenmon)
                        store.dispatch({
                        type: 'GET_THI',
                        thi:res.data.thi
                    })
                   
                        let time = res.data
                        store.dispatch({
                        type: 'GET_TIME',
                        timer:time
                    })
                   
                    
                    }) 
                   

                    }
                })
              
            }
   
            handleViewPoint(){
                axios({
                    method: 'get',
                    url: '{{ route('laydiem.check') }}',
                })
                .then( res=>{
                    console.log(res)
                   let danhsachdiem = res.data
                   store.dispatch({
                       type: 'GET_DANHSACHDIEM',
                       danhsachdiem,
                      
                   })
                   store.dispatch({
                       type: 'GET_Show',
                       show:true
                   })
                   store.dispatch({
                       type: 'GET_TRANGTHAIMONTHI',
                       boolTrangthaimonthi: false,      
                   })    
                   store.dispatch({
                       type: 'GET_Show1',
                       show1:false
                   })
                   store.dispatch({
                       type: 'GET_Show2',
                       show2:false
                   })

                })
            }
            handleGetHistory(TenMH,ID){
                store.dispatch({
                       type: 'GET_IDMH',
                       idmon:ID
                   })
                   store.dispatch({
                       type: 'GET_Show',
                       show:false
                   })
                   store.dispatch({
                       type: 'GET_TRANGTHAIMONTHI',
                       boolTrangthaimonthi: false,      
                   })    
                   store.dispatch({
                       type: 'GET_Show1',
                       show1:false
                   })
                   store.dispatch({
                       type: 'GET_Show2',
                       show2:true
                   })
               // axios gọi danh sach cau hỏi
               axios({
                  method: 'post',
                  url: '{{ route('laylichsuthi.check') }}',
                    data:{
                       ID

                    }
              })
              .then( res=>{
                  let danhsachcauhoi = res.data
                store.dispatch({
                       type: 'GET_DANHSACHCAUHOI',
                       danhsachcauhoi
                   })
              
                 
              } )

            }
               
    
            render() {
                return (
                    <div className=" col-lg-3 col-md-3 col-3">
                        <div className="content_left">
                            <h3 className="title">Danh sách môn thi</h3>
                            <ul className="danhsachmonhoc">
                                {
                                    this.state.data.map( (value,index)=>{
                                        return(
                                            <div key={value.ID}>
                                                <li  onClick={()=>this.handleCheckPoint(value.TenMonHoc,value.ID)}>
                                                    {value.TenMonHoc}
                                                </li>
                                            </div>
                                        )
                                    })
                                }
                            </ul>
                            <h6 id="danhsach" onClick={()=>this.handleViewPoint()} className="title">
                                Danh Sách Điểm Cá Nhân
                            </h6>
                            <div className="dropdown">
                                <button className="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    History
                                </button>
                                <div className="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                {
                                    this.state.data.map( (value,index)=>{
                                        return(
                                            <div key={value.ID}>
                                               
                                            <a className="dropdown-item" href="#" onClick={()=>this.handleGetHistory(value.TenMonHoc,value.ID)}>{value.TenMonHoc}</a>

                                            </div>
                                        )
                                    })
                                }
                                    
                                   
                                </div>
                                </div>
                        </div>
                    </div>
                );
            }
        };

       
        class Noidung extends Component {
            constructor(props){
                super(props);
            }
            handleStart(){
               if(dkthi == true ){
              window.location.href = "{{ route('thi.view') }}" + "/?" + "tenmon"+"="+tenmon; 
             
               }
               else{
                alert(" Chưa đến thời gian thi")
               }
           }

            render() {
               // dkthi=this.props.thi
                return this.props.boolTrangthaimonthi ? (
                    <div>
                        <div className="col-lg-9 col-md-9 pt-2">
                            <div className="noidung_info">
                                <p id="tenmon"> <span>Tên môn học: {this.props.tenmh}</span></p>
                                <p id="ngaythi">Ngày Thi: {new Date(this.props.timer.start).toLocaleDateString()}</p>
                                <p id="thoigianbatdau">Thời gian bắt đầu: {(new Date(this.props.timer.start).toTimeString()).slice(0, 9)}</p>
                                <p id="thoigianketthuc">Thời gian kết thúc: {(new Date(this.props.timer.end).toTimeString()).slice(0, 9)}</p>
                                <button className="btn btn-primary" id="btnbatdau" type="button" onClick={this.handleStart}>Bắt đầu</button>
                            </div>
                        </div>
                    </div>
                ) : '';
            }
        };


        class ThongTin extends Component {
        
            constructor(props){
                super(props);
              
            }
         
            handleLogout(){
            window.location.href = "{{ route('logout.view') }}";
            }
               
            
            componentDidMount(){
              
                axios({
                    method: 'get',
                    url: '{{ route('laythongtin.check') }}',
                })
                .then( res=>{
                   let user = res.data
                   store.dispatch({
                       type: 'GET_USER',
                       user
                   })
                   
                    
                } )
            }
            render() {
                console.log(this.props);
                return (
                    
                   <div>
                        <HistoryConnected/>
                       <DiemtheomonConnected /> 
                        <DiemConnected />
                        <div className="thongtin">
                        <button id="ten" className="btn btn-info mr-1">
                            Xin chào ,
                           {
                             this.props.user
                           }
                         </button>
                        <button className="btn btn-danger" onClick={this.handleLogout} >Logout</button>
                    </div>
                </div>
                );
            }
        };
        
        class Diemtheomon extends Component{
            constructor(props){
                super(props);
               
            }
            render(){
               return this.props.show1 ?(
                    
                    <div>
                     
                         <div id="diem">
                                { 
                                    <h5>Tên môn học: {this.props.tenmh} 
                                    </h5>
                                    
                                }
                                {
                                    <h5> Điểm : {this.props.diemtungmon}   
                                    </h5>
                                }
 
                             </div>
                        
                 </div>
                 ) :'';
            }
        }
        class Diem extends Component {
           
            constructor(props){
                super(props);
            }
            render() {
               
                return this.props.show ?(
                   <div>
                        <div id="diem">
                                  {  
                                <table>  
                                <thead><tr><th>Tên Môn Học </th><th>Điểm</th></tr></thead>
                                <tbody>
                                {
                                this.props.danhsachdiem.map( (value,index)=>{
                                        return(
                                             <tr key={index}><td>{value.TenMonHoc}</td><td>{value.Diem}</td></tr>
                                       )
                                   })
                                }
                             </tbody>
                               </table>
                            }
                            </div>
                            
                </div>
                ) :'';
               
            }
        };

        class History extends Component {
           
           constructor(props){
               super(props);
           }
           render() {
              
               return this.props.show2 ?(
                  <div>
                       <div id="history">
                           {  
                              
                         <h1>History </h1>

                           }
                           </div>
                           
               </div>
               ) :'';
              
           }
       };
        // connect the component to the Redux store
        const ThongTinConnected = connect( (state)=>({ user : state.user }))(ThongTin);
        const NoidungConnected =  connect( (state)=>({ boolTrangthaimonthi:state.boolTrangthaimonthi,tenmh:state.tenmh,timer:state.timer,thi:state.thi ,idmon:state.idmon, show2:state.show2,danhsachcauhoi:state.danhsachcauhoi}))(Noidung);
        const DiemConnected = connect( (state)=>({ danhsachdiem:state.danhsachdiem, show:state.show,show1:state.show1,diemtungmon:state.diemtungmon,tenmh:state.tenmh,idmon:state.idmon,show2:state.show2,danhsachcauhoi:state.danhsachcauhoi }))(Diem);
        const DanhsachmonhocConnected = connect( (state)=>({  show:state.show ,show1:state.show1,diemtungmon:state.diemtungmon,tenmh:state.tenmh,idmon:state.idmon,show2:state.show2,danhsachcauhoi:state.danhsachcauhoi}))(Danhsachmonhoc)
        const DiemtheomonConnected = connect( (state)=>({ show1:state.show1,diemtungmon:state.diemtungmon,tenmh:state.tenmh,idmon:state.idmon,show2:state.show2,danhsachcauhoi:state.danhsachcauhoi}))(Diemtheomon)
        const HistoryConnected = connect( (state)=>({ show1:state.show1,diemtungmon:state.diemtungmon,tenmh:state.tenmh,idmon:state.idmon,show2:state.show2,danhsachcauhoi:state.danhsachcauhoi}))(History)
        ReactDOM.render(
            <Provider store={store}>
                <App />
            </Provider>,
            document.getElementById('app')
        );
    </script>
   
</body>
</html>