// Sidebar Toggle Script
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('toggle-sidebar').addEventListener('click', function () {
        const sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('collapsed');

        const content = document.querySelector('.content');
        content.classList.toggle('collapsed'); // Update content margin when sidebar is collapsed

        const icon = this.querySelector('i');
        if (sidebar.classList.contains('collapsed')) {
            icon.classList.remove('fa-chevron-left');
            icon.classList.add('fa-chevron-right');
        } else {
            icon.classList.remove('fa-chevron-right');
            icon.classList.add('fa-chevron-left');
        }
    });
});



// Data untuk Segmentation
const segmentationData = [
    { name: "Not Specified", value: 800, color: "#363636" },
    { name: "Male", value: 441, color: "#818bb1" },
    { name: "Female", value: 233, color: "#2c365d" },
    { name: "Other", value: 126, color: "#334ed8" },
];

// Segmentation Chart Component
function SegmentationChartComponent() {
    return (
        <div>
            <h5>Segmentation</h5>
            <div>
                {segmentationData.map((item) => (
                    <div className="segmentation-item" key={item.name}>
                        <div
                            style={{
                                backgroundColor: item.color,
                            }}
                        ></div>
                        <div>{item.name}</div>
                        <div className="seg-value">{item.value}</div>
                    </div>
                ))}
            </div>
            <div>
                <button className="btn btn-outline-light mt-3">Details</button>
            </div>
        </div>
    );
}

// Satisfaction Gauge Component
function SatisfactionGaugeComponent() {
    const { dashOffset } = useSpring({
        dashOffset: 78.54,
        from: { dashOffset: 785.4 },
    });
    return (
        <div className="text-center">
            <h5>Satisfaction</h5>
            <svg viewBox="0 0 700 380" width="200">
                <path
                    d="M100 350C100 283.696 126.339 220.107 173.223 173.223C220.107 126.339 283.696 100 350 100C416.304 100 479.893 126.339 526.777 173.223C573.661 220.107 600 283.696 600 350"
                    stroke="#2d2d2d"
                    strokeWidth="40"
                    strokeLinecap="round"
                />
                <animated.path
                    d="M100 350C100 283.696 126.339 220.107 173.223 173.223C220.107 126.339 283.696 100 350 100C416.304 100 479.893 126.339 526.777 173.223C573.661 220.107 600 283.696 600 350"
                    stroke="#2f49d0"
                    strokeWidth="40"
                    strokeLinecap="round"
                    strokeDasharray="785.4"
                    strokeDashoffset={dashOffset}
                />
            </svg>
            <div className="mt-3">
                <span className="fs-4 fw-bold text-primary">97.78%</span>
                <p className="satisfaction-text">Based on Likes</p>
            </div>
        </div>
    );
}

// Render Components
ReactDOM.render(<SegmentationChartComponent />, document.getElementById("segmentation-chart-root"));
ReactDOM.render(<SatisfactionGaugeComponent />, document.getElementById("satisfaction-gauge-root"));