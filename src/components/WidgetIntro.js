function WidgetIntro(props){
    return (
        <div className="boxIntro ">
            <div className="row introSpacer">
                <div className="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12 widget2 logoMIntro">
                    <div id="home">
                        <div className="widget-chart-one">
                            <div>
                                <h3>Welcome to <strong>xSURGE</strong></h3>
                                <h4>The Defi Revolution</h4>
                                <h5>
                                    Explore our fast growing smart chain ecosystem that fosters innovation and encourages a truly decentralized future through on-chain liquidity, and fully renounced ownership.
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div className="col-xl-3 col-lg-3 col-md-3 logoM text-center align-self-center">
                    <img className="logo rounded mx-auto d-block" src="assets/img/xlogo.png" alt="logo"/>
                </div>
            </div>
        </div>
    )
}

export default WidgetIntro;