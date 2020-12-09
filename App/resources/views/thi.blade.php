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
    .viengiua{
    border: 1px solid blue;
    height: 100%;
    position: fixed;
    left: 75%
}
.vien1{
    overflow:auto;
}
xmp{
    font-family:  "Helvetica Neue",Helvetica,Arial,sans-serif;
    white-space: pre-wrap ;
    display: inline;
}
.thongtinthi{
    position: fixed;

}
ul li{
    list-style-type: none;
    display: inline;
}
body{
    background: #e6fff7;

    color: #000;
}
#dongho{
    color: red;
}

</style>
</head>
<body>
    <div id="app"></div>
    <script type="text/babel">

        function getUrlParameter(name) {
            name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
            var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
            var results = regex.exec(location.search);
            return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
        };
        
        let tenmh = getUrlParameter('tenmon');
       
    const { Component } = React;
    const { createStore } = Redux;
    const { Provider, connect } = ReactRedux;
    const initState = {
           soluongcauhoi : 0,
           tenmh:tenmh,
           danhsachcauhoi:[],
           dapansubmit:[],
           timer : [],
           time:''
        };
        var socauhoi = 0;
        var dapan = [];
        var idch = [];
        var thoigianketthuc = 0;
        var phut = 0;
        var giay = 0;
        const reducer = (state = initState, action) => {
            switch (action.type) {
                case 'GET_SOLUONGCAUHOI': {
                    
                    return {...state,soluongcauhoi: action.soluongcauhoi}
                }
                case 'GET_TENMH': {
                    
                    return {...state,tenmh: action.tenmh}
                }
                case 'GET_DANHSACHCAUHOI': {
                   
                    return {...state,danhsachcauhoi: action.danhsachcauhoi}
                }
                case 'GET_DAPANSUBMIT': {
                   
                   return {...state,dapansubmit: action.dapansubmit}
                }
                case 'GET_TIME': {
                 
                    return {...state, timer: action.timer}
                }
                case 'GET_TIMER': {
                    
                    return {...state, time: action.time}
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
                          < ListQuestionConnected/>
                        <div className="viengiua" />
                          <ThongTinThiConnected />
                        </div>   
                    </div>
                )
            }
        };
        class ListQuestion extends Component{
            constructor(props){
                super(props);
            }

            componentDidMount(){
              
              axios({
                  method: 'post',
                  url: '{{ route('danhsachcauhoi.check') }}',
                    data:{
                        tenmh:tenmh
                    }
              })
              .then( res=>{
                
              
                 socauhoi=res.data.length
                 let soluongcauhoi = res.data.length;
                 let danhsachcauhoi = res.data
                 store.dispatch({
                     type: 'GET_SOLUONGCAUHOI',
                     soluongcauhoi
                 })
                 store.dispatch({
                     type: 'GET_DANHSACHCAUHOI',
                     danhsachcauhoi
                 })
                 for(var i = 0 ; i < socauhoi ; i++){
                  dapan[i] = null;
              }
                  
              console.log(dapan);
              } )
              

          }

          handleCheckPoint(index1,dapanID){
            for(var i = 0 ; i < socauhoi ; i ++){
                if(i == index1){
                dapan[i] = dapanID;
                break;
                }
            }
               console.log(dapan)
          }
          


         render(){
           
            return(
             <div className="col-md-9 vien1">
                <div className="cauhoi">
                    {
                    this.props.danhsachcauhoi.map( (value,index1)=>{
                            idch.push(value.ID);
                                        return(
                                            <div key={index1} >
                                                <div className="cauhoi">
                                                  <span>Câu {index1+1}: {value.NoiDung}</span> 

                                                  <ol type="A">
                                                 { 
                                                     value.DapAn.map((value1,index)=>{
                                                         return(    
                                                         //<div key={index}>
                                                         <li key={index}>
                                                         <input 
                                                            type="radio" name={index1} defaultValue={value1.ID}
                                                            onClick={()=>this.handleCheckPoint(index1,value1.ID)}
                                                         />
                                                     
                                                         <span> {value1.NoiDung}</span>
                                                         </li>
                                                        //</div>
                                                         )
                                                     })
                                                 }
                                                
                                                 </ol>
                                                </div>
                                            </div>
                                        )
                                    })
                    }
                </div>
             </div>
            );
         }
        };
      //  console.log(idch);
        class ThongTinThi extends Component{
            constructor(props){
                super(props);
            }
            componentDidMount(){
              
             
          

            store.dispatch({
                     type: 'GET_TENMH',
                     tenmh
                 })

            

              axios({
                    method: 'post',
                    url: '{{ route('laythoigian.check') }}',
                    data:{
                        TenMH:tenmh
                    }
                })
              .then( res=>{ 
                    console.log(res.data)
                    let time = res.data
                        store.dispatch({
                        type: 'GET_TIME',
                        timer:time
                    })

                    thoigianketthuc = new Date(res.data.end).getTime();
                    let bayh = parseInt((new Date).getTime()/ 1000);
                    console.log(idch);
                    console.log(thoigianketthuc)
                    console.log((new Date).getTime()/ 1000)

                //    if(thoigianketthuc > )
                    
                        var x = setInterval(function() {

                            // Get today's date and time
                            var now = new Date().getTime();
                                
                            // Find the distance between now and the count down date
                            var distance = thoigianketthuc - now;
                                
                            // Time calculations for days, hours, minutes and seconds
                            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                            
                             store.dispatch({
                                type: 'GET_TIMER',
                                time: hours + " h : " + minutes + " phut " +": "+ seconds + " giay "
                             })
                            // If the count down is over, write some text 
                            if (distance < 0) {
                                clearInterval(x);
                                store.dispatch({
                                    type: 'GET_TIMER',
                                    time: ""
                                })
                                    axios({
                                    method: 'post',
                                    url: '{{ route('chamdiem.check') }}',
                                    data: {
                                            dapan,
                                            socauhoi
                                            },

                                })
                                .then(function (response) {
                                    alert(response.data);
                                })
                                .catch(function (error) {
                                    console.log(error);
                                });
                              //  window.location.href = "{{ route('view_user.check') }}";
                            }
                        }, 1000);
                    
                   
                }) 
           
          }

            Submit(){
                var check = true;
                for( var i = 0 ; i < socauhoi ; i++){
                    if(dapan[i] == null){
                        check = false; 
                        break;
                    }
                }
               
                 
                if( (!check && confirm('bạn chưa làm xong câu hỏi,có muốn nộp bài không')) || check ){
                    axios({
                        method: 'post',
                        url: '{{ route('chamdiem.check') }}',
                        data: {
                            dapan,
                            socauhoi
                        },
                    }).then(function (response) {
                        //cham diem xong thi luu cau tra loi tai day...
                        axios({
                            method: 'post',
                            url: '{{ route('lichsuthi.check') }}',
                            data: {
                                tenmh:tenmh,
                                dapan,
                                idch
                            },
                        }).then(function (response2) {
                           // alert(response.data);

                            //in diem va ve trang dau tien
                            alert(response.data);
                            window.location.href = "{{ route('view_user.check') }}";
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                }
            }


            render(){
                console.log(this.props);
                return(
                    <div className="col-md-3">
                        <div className="thongtinthi">
                            <h4 id="vien2" >Tên môn thi: {this.props.tenmh}</h4>
                            <h4 id="soluongcauhoi" >Số lượng câu hỏi: {this.props.soluongcauhoi}</h4>
                            <p id="dongho">Thời gian: { this.props.time} </p>
                            <input
                                type="button"
                                id="nopbai"
                                defaultValue="Nộp bài"
                                className="btn btn-primary"
                                onClick={()=>this.Submit()}
                            />
                        </div>
                    </div>
                )
            }
        };
        const ThongTinThiConnected = connect( (state)=>({ soluongcauhoi : state.soluongcauhoi,tenmh:state.tenmh,danhsachcauhoi:state.danhsachcauhoi,dapansubmit:state.dapansubmit,timer:state.timer,time:state.time }))(ThongTinThi);
        const ListQuestionConnected = connect( (state)=>({ soluongcauhoi : state.soluongcauhoi,danhsachcauhoi:state.danhsachcauhoi,dapansubmit:state.dapansubmit }))(ListQuestion);
        ReactDOM.render(
            <Provider store={store}>
                <App />
            </Provider>,
            document.getElementById('app')
        );
      
    </script>
</body>
</html>